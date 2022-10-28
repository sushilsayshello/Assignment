<!DOCTYPE html>
<html>

<head>
    <title>Shopping List Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

    <header>
        <h1>Shopping List Manager</h1>
    </header>

    <main>



<!-- The Items are displayed -->
       <h2>Items:</h2>
        <?php if (count($Item_list) == 0) : ?>
            <p>There are no Items in the Item list.</p>
        <?php else: ?>
            <ul>
            <?php foreach( $Item_list as $id => $Item ) : ?>
                <li><?php echo $id + 1 . '. ' . $Item; ?></li>
            <?php endforeach; ?>
            </ul>           
        <?php endif; ?>
        <br>

<!-- The form for adding items-->
        <h2>Add Item:</h2>
        <form action="." method="post" >
            <?php foreach( $Item_list as $Item ) : ?>
              <input type="hidden" name="Itemlist[]" value="<?php echo $Item; ?>">
            <?php endforeach; ?>
            <label>Item:</label>
            <input type="text" name="newItem" id="newItem"> <br>
            <label>&nbsp;</label>
            <input type="submit" name="action" value="Add Item">
        </form>
        <br>

<!-- The modify/sort/delete form -->
<?php if (count($Item_list) > 0 && empty($Item_to_modify)) : ?>
        <h2>Select Item:</h2>
        <form action="." method="post" >
            <?php foreach( $Item_list as $Item ) : ?>
              <input type="hidden" name="Itemlist[]" value="<?php echo $Item; ?>">
            <?php endforeach; ?>
            <label>Item:</label>
            <select name="Itemid">
                <?php foreach( $Item_list as $id => $Item ) : ?>
                    <option value="<?php echo $id; ?>">
                        <?php echo $Item; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <label>&nbsp;</label>

<!-- Options for users to click button so that they can modify, delete or sort items -->
            <input type="submit" name="action" value="Modify Item">
            <input type="submit" name="action" value="Delete Item">

            <br><br>
            <label>&nbsp;</label>
            <input type="submit" name="action" value="Sort Items">
        </form>
        <?php endif; ?>

<!-- The modify save/cancel form -->
        <?php if (!empty($Item_to_modify)) : ?>
        <h2>Item to Modify:</h2>
        <form action="." method="post" >
            <?php foreach( $Item_list as $Item ) : ?>
              <input type="hidden" name="Itemlist[]" value="<?php echo $Item; ?>">
            <?php endforeach; ?>
            <label>Item:</label>
            <input type="hidden" name="modifiedItemid" value="<?php echo $Item_index; ?>">
            <input type="text" name="modifiedItem" value="<?php echo $Item_to_modify; ?>"><br>
            <label>&nbsp;</label>

<!-- Options for users to click on save or cancel the modify process -->
            <input type="submit" name="action" value="Save Changes">
            <input type="submit" name="action" value="Cancel Changes">
        </form>
        <?php endif; ?>


    </main>
</body>
</html>
