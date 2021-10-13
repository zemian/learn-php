/* Custom JS for FoxPages - For admin.php only. */

function getCodeMirrorMode(fileName) {
    var mode = fileName.split('.').pop();
    if (mode === 'md') {
        // ext = 'markdown';
        mode = 'gfm'; // Use GitHub Flavor Markdown
    } else if (mode === 'json') {
        mode = {name: 'javascript', json: true};
    } else if (mode === 'html') {
        mode = 'htmlmixed';
    }
    return mode;
}

function loadCodeMirror(textAreaId, fileName) {
    var mode = getCodeMirrorMode(fileName);
    var el = document.getElementById(textAreaId);
    var editor = CodeMirror.fromTextArea(el, {
        lineNumbers: true,
        mode: mode,
        theme: 'default',
    });
    editor.setSize(null, '500');
    return editor;
}

function addElementEventListener(eventName, elementId, callback) {
    var el = document.getElementById(elementId);
    el.addEventListener(eventName, (event) => {
        callback(event);
    });
}
