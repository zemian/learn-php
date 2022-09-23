<lable>PHP Filters</lable>
<select name="filter">
    <?php foreach(filter_list() as $filter): ?>
    <option value="<?php echo $filter?>"><?php echo $filter?></option>
    <?php endforeach; ?>
</select>
