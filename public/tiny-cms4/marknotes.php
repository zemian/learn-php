<?php
/*
 * This is the FoxPages application file. We define all the re-usable code here.
 * Author: Zemian Deng Nov 2020
 */


require_once 'parsedown.php';
/**
 * Main application class.
 */
class FoxPagesApp {
    const LOG_LEVEL = array('debug' => 10, 'info' => 20, 'warning' => 30, 'error' => 40, 'off' => PHP_INT_MAX);
    const SESSION_KEY = 'marknotes';
    var $name = 'FoxPages';
    var $version = '1.0.0';
    var $config;
    var $file_service;
    var $parsedown;

    function __construct() {
        $config_path = $_SERVER['MARKNOTES_CONFIG'] ?? (__DIR__ . "/notes/.config/marknotes.json");
        $config = file_get_contents($config_path);
        $this->config = json_decode($config, true);        
        $this->file_service =  new FileService($this->config['content_dir'], $this->config['allow_extensions']);
        $this->parsedown = new Parsedown();
    }

    function log($level, ...$vars) {
        if (!array_key_exists($level, self::LOG_LEVEL)) {
            // If first argument is not a log level, default it to 'debug'
            array_unshift($vars, $level);
            $level = 'debug';
        }
        $conf_level_n = self::LOG_LEVEL[$this->config['log_level']];
        $level_n = self::LOG_LEVEL[$level];
        if ($level_n >= $conf_level_n) {
            $logfile = $this->config['log_file'];
            $ts = date('Ymd-H:i:s');
            foreach ($vars as $var) {
                if (is_array($var)) {
                    $msg = print_r($var, true);
                } else {
                    $msg = $var . PHP_EOL;
                }
                file_put_contents($logfile, $ts . ' ' . $level . ' ' . $msg, FILE_APPEND);
            }
        }
    }

    function get_notes($parent_dir = '') {
        return $this->file_service->get_files($parent_dir);
    }

    function get_note_subdirs($parent_dir = '', $is_for_admin = false) {
        if (!is_dir($this->file_service->realpath($parent_dir)))
            return [];
        
        $ret = $this->file_service->get_dirs($parent_dir);
        
        // If not for admin then it's for display on site
        if (!$is_for_admin) {
            // Exclude all dot folders
            $ret = array_filter($ret, function ($item) {
                return substr_compare($item, '.', 0, 1) !== 0;
            });

            // Exclude any found in $exclusions list
            $exclusions = $this->config['exclude_folders'];
            $ret = array_filter($ret, function ($item) use ($exclusions) {
                return !in_array($item, $exclusions);
            });
        }
        
        return $ret;
    }
    
    function is_allowed_to_display($note) {
        // We will not serve any dot files or folders.
        if (substr_compare($note, '.', 0, 1) === 0) {
            return false;
        }
        
        // We will not serve any exclusion folders.
        $exclusions = $this->config['exclude_folders'];
        return !in_array($note, $exclusions);
    }

    function get_note_content($note, $is_for_admin = false) {
        if (!$this->file_service->exists($note)) {
            $result = "Note not found: $note";
        } else if (!$is_for_admin && !$this->is_allowed_to_display($note)) {
            $result = "Note not found: $note";
        } else {
            $note_content = $this->file_service->read($note);
            $result = $this->transform_content($note_content, $note, $is_for_admin);
        }
                
        return $result;
    }

    function transform_content($note_content, $file, $is_for_admin) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext === 'md') {
            $result = $this->parsedown->text($note_content);
        } else if ($ext === 'txt' || ($is_for_admin && $ext === 'json')) {
            $result = "<pre>$note_content</pre>";
        } else {
            $result = $note_content;
        }
        return $result;
    }
    
    function get_template_path($name) {
        $templates_dir = $this->config['templates_dir'];
        return "$templates_dir/$name";
    }
    
    function get_note_template($note) {
        // Return a template based on file name extension.
        $ext = pathinfo($note, PATHINFO_EXTENSION);
        $template = $this->get_template_path("note-$ext.php");
        if (file_exists($template)) {
            return $template;
        }
        return $this->get_template_path("note.php");
    }

    function redirect($path) {
        header("Location: $path");
        exit;
    }
    
    function validate_note_name($name, $check_file_exists = true) {
        $error = 'Invalid name: ';
        $max_depth = $this->config['max_menu_levels'];
        $n = strlen($name);
        if (!($n > 0 && $n < 30 * $max_depth)) {
            $error .= 'Must not be empty and less than 100 chars.';
        } else if (!preg_match('/^[\w_\-\.\/]+$/', $name)) {
            $error .= "Must use alphabetic, numbers, '_', '-' characters only.";
        } else if (!$this->file_service->is_allowed($name)) {
            $error .= "Wrong extension. Allowed extension are: " . $this->get_supported_extensions();
        } else if ($check_file_exists && $this->file_service->exists($name)) {
            $error .= "Note name already exists.";
        } else if (substr_count($name, '/') > $max_depth) {
            $error .= "File nested path be less than $max_depth levels.";
        } else {
            $error = null;
        }
        return $error;
    }
        
    function validate_note_content($content) {
        $error = 'Invalid note content: ';
        $n = strlen($content);
        if (!($n < 1024 * 1024 * 10)) {
            $error .= 'Must be less than 10MB.';
        } else {
            $error = null;
        }
        return $error;
    }
    
    function get_supported_extensions() {
        return implode(', ', $this->config['allow_extensions']);
    }
    
    function get_note_label($note) {
        if (!$this->config['is_pretty_link']) {
            return $note;
        }
        $note = pathinfo($note, PATHINFO_FILENAME);
        $note = preg_replace('/([A-Z])/', " $1", $note);
        $note = preg_replace('/([\-_])/', " ", $note);
        $note = preg_replace_callback('/( [a-z])/', function ($matches) {
            return strtoupper($matches[0]);
        }, $note);
        $note = trim($note);
        $note = ucfirst($note);
        return $note;   
    }

    /**
     * An example menu_link structure:
     {
        "menu_links": {
            "menu_label": "Notes",
            "menu_name": "",
            "menu_order": 0,
            "links": [
                {"link_label":  "Home", "name": "home.md", "order":  0},
                {"link_label":  "Search", "url": "https://www.google.com", "order":  1}
            ],
            "child_menu_links": []
        }
     }
     NOTE: A link object may have either "name" (used for link to note name) or "url" (direct URL) attribute.
     */
    function get_menu_links($is_for_admin = false) {
        if (isset($this->config['menu_links'])) {
            $menu_links = $this->config['menu_links'];
        } else if ($this->config['is_auto_links'] ?? true) {
            $max = $this->config['max_menu_levels'];
            $menu_links = $this->get_note_tree('', $max, $is_for_admin);
        }
        
        // Check for menu_links_override
        if (isset($this->config['menu_links_override'])) {
            $name_map = $this->config['menu_links_override'];
            $this->override_menu_links($menu_links, $name_map);
        }
        
        // Sort links according to the 'order' attr
        $this->sort_menu_links($menu_links);
        
        $this->log('debug', '$menu_links', $menu_links);
        return $menu_links;
    }
    
    private function override_menu_links(&$menu_links, $name_map) {
        // Override menu attributes if given (per notes dir)
        if (array_key_exists($menu_links['menu_name'], $name_map)) {
            $new_attrs = $name_map[$menu_links['menu_name']];
            foreach ($new_attrs as $k => $v) {
                $menu_links[$k] = $v;
            }
        }
        
        // Override each links (files)
        $is_disable_pretty_link = isset($menu_links['is_disable_pretty_link']) && $menu_links['is_disable_pretty_link'] === true;
        foreach ($menu_links['links'] as &$link) {
            if (array_key_exists($link['name'], $name_map)) {
                $new_link = $name_map[$link['name']];
                foreach ($new_link as $k => $v) {
                    $link[$k] = $v;
                }
            }

            if ($is_disable_pretty_link) {
                $link['link_label'] = basename($link['name']);
            }
        }
        

        foreach ($menu_links['child_menu_links'] as &$child_item) {
            $this->override_menu_links($child_item, $name_map);
        }
    }
    
    // We need to accept array reference so we can modify array in-place!
    private function sort_menu_links(&$menu_links) {
        usort($menu_links['links'], function ($a, $b) { 
            $ret = $a['order'] <=> $b['order'];
            if ($ret === 0) {
                $ret = $a['link_label'] <=> $b['link_label'];
            }
            return $ret;
        });
        usort($menu_links['child_menu_links'], function ($a, $b) { 
            $ret = $a['menu_order'] <=> $b['menu_order'];
            if ($ret === 0) {
                $ret = $a['menu_label'] <=> $b['menu_label'];
            }
            return $ret;
        });
        foreach ($menu_links['child_menu_links'] as $menu_link) {
            $this->sort_menu_links($menu_link);
        }
    }

    private function get_note_tree($dir = '', $level = 2, $is_for_admin = false, $menu_order = 1024) {
        $menu_links = array(
            "menu_label" => null,
            "menu_name" => null,
            "menu_order" => $menu_order,
            "links" => [],
            "child_menu_links" => []
        );
        $dir_name = pathinfo($dir, PATHINFO_FILENAME);
        $dir_name = $dir_name === '' ? $dir : $dir_name; // Handle '.config' dir case.
        $menu_label = ($dir === '') ? $this->config['root_menu_label'] : $dir_name;
        $menu_links['menu_label'] = $menu_label;
        $menu_links['menu_name'] = $dir;
        
        $files = ($is_for_admin) ? $this->file_service->get_files($dir) : $this->get_notes($dir);
        $i = 1024;
        foreach ($files as $file) {
            $file_path = ($dir === '') ? $file : "$dir/$file";
            array_push($menu_links['links'], array(
                'name' => $file_path,
                'order' => $i++,
                'link_label' => $this->get_note_label($file)
            ));
        }
        
        if ($level > 0) {
            $sub_dirs = ($is_for_admin) ? $this->file_service->get_dirs($dir) : $this->get_note_subdirs($dir);
            foreach ($sub_dirs as $sub_dir) {
                $dir_path = ($dir === '') ? $sub_dir : "$dir/$sub_dir";
                $sub_tree = $this->get_note_tree($dir_path, $level - 1, $is_for_admin, $menu_order + 1);
                array_push($menu_links['child_menu_links'], $sub_tree);
            }
        }
        return $menu_links;
    }
    
    private function echo_menu_links_($menu_links, $is_for_admin = false) {
        $controller = ($is_for_admin) ? 'admin.php' : 'index.php';
        echo "<p class='menu-label'>{$menu_links['menu_label']}</p>";
        echo "<ul class='menu-list'>";
        
        $i = 0; // Use to track last item in loop
        $files_len = count($menu_links['links']);
        foreach ($menu_links['links'] as $item) {
            if (!$is_for_admin && isset($item['is_exclude_display']) && $item['is_exclude_display'] === true) {
                continue;
            }
            $link = $item['url'] ?? "$controller?note={$item['name']}";
            echo "<li><a href='$link'>{$item['link_label']}</a>";
            if ($i++ < ($files_len - 1)) {
                echo "</li>"; // We close all <li> except last one so Bulma memu list can be nested
            }
        }
        
        foreach ($menu_links['child_menu_links'] as $child_menu_links_item) {
            $this->echo_menu_links_($child_menu_links_item, $is_for_admin);
        }
        echo "</li>"; // Last menu item
        echo "</ul>";
    }
    
    function echo_menu_links($is_for_admin = false) {
        $menu_links = $this->get_menu_links($is_for_admin);
        $this->echo_menu_links_($menu_links, $is_for_admin);
    }
    
    function is_admin_password_protected() {
        return (isset($this->config['admin_password']) && $this->config['admin_password'] !== '');
    }
    
    function get_session() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION[self::SESSION_KEY])) {
            return $_SESSION[self::SESSION_KEY];
        }
        return null;
    }
    
    function login($password) {
        $n = strlen($password);
        if (!($n > 0 && $n < 20) || $password !== $this->config['admin_password']) {
            return "Invalid Password";
        } else {
            $_SESSION[self::SESSION_KEY] = array('login_ts' => time());
            return null;
        }
    }

    function logout() {
        $ret = $_SESSION[self::SESSION_KEY];
        unset($_SESSION[self::SESSION_KEY]);
        return $ret;
    }
}

/**
 * FileService provide files and sub dir access relative from a single "root_dir".
 */
class FileService {
    var $root_dir;
    var $allowed_ext_list;

    function __construct($root_dir, $allowed_ext_list) {
        $this->root_dir = $root_dir;
        $this->allowed_ext_list = $allowed_ext_list;
    }
    
    function realpath($file) {
        // Always remove trailing slash
        return rtrim($this->root_dir . "/" . $file, '/');
    }
    
    function is_allowed($file) {
        // Check to see if file extension is in the allowed list
        foreach ($this->allowed_ext_list as $ext) {
            $len = strlen($ext);
            if (substr_compare($file, $ext, -$len) === 0) {
                return true;
            }
        }
        return false;
    }

    function get_files($sub_path = '') {
        $path = $this->realpath($sub_path);
        $files = array_slice(scandir($path), 2);
        $ret = array_filter($files, function ($file) use ($path) {
            return is_file($path . "/" . $file) && $this->is_allowed($path . "/" . $file);
        });
        return $ret;
    }
    
    function get_dirs($sub_path = '') {
        $path = $this->realpath($sub_path);
        $files = array_slice(scandir($path), 2);
        $ret = array_filter($files, function ($file) use ($path) {
            return is_dir($path . "/" . $file);
        });
        return $ret;
    }

    function exists($file) {
        return file_exists($this->root_dir . "/" . $file);
    }

    function read($file) {
        return file_get_contents($this->root_dir . "/" . $file);
    }

    function write($file, $contents) {
        $file_path = $this->root_dir . "/" . $file;
        $dir_path = pathinfo($file_path, PATHINFO_DIRNAME);
        if (!is_dir($dir_path)) {
            mkdir($dir_path, 0777, true);
        }
        return file_put_contents($file_path, $contents);
    }

    function delete($file) {
        // Will auto check exists first before delete. If not exists, it will not error.
        return $this->exists($file) && unlink($this->root_dir . "/" . $file);
    }
}
