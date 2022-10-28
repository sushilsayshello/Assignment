<?php
//get Itemlist array from POST
$Item_list = filter_input(INPUT_POST, 'Itemlist', FILTER_DEFAULT,                  
                          FILTER_REQUIRE_ARRAY);
if ($Item_list === NULL) {
    $Item_list = array();

// adding some hard-coded starting values to make testing easier
$Item_list[] = 'Milk';
$Item_list[] = 'Banana';
$Item_list[] = 'Orange';
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//process
switch( $action ) {
    //Initiate for adding item while user clicks on add item
    case 'Add Item':
        $new_Item = filter_input(INPUT_POST, 'newItem');
        if (empty($new_Item)) {
            $errors[] = 'The new Item cannot be empty.';
        } else {
            $Item_list[] = $new_Item;
        }
        break;
    
//Initiate when item is selected and chosen to be deleted
    case 'Delete Item':
        $Item_index = filter_input(INPUT_POST, 'Itemid', FILTER_VALIDATE_INT);
        if ($Item_index === NULL || $Item_index === FALSE) {
            $errors[] = 'The Item cannot be deleted.';
        } else {
            unset($Item_list[$Item_index]);
            $Item_list = array_values($Item_list);
        }
        break;

//Initiate when item is selected and chosen to be modified
        case 'Modify Item':
            $Item_index = filter_input(INPUT_POST, 'Itemid', FILTER_VALIDATE_INT);
            if ($Item_index === NULL || $Item_index === FALSE) {
            $errors[] = 'The Item cannot be modified.';
            } else {
            $Item_to_modify = $Item_list[$Item_index];
            }          
            break;
            
//Initiate when item is edited and chosen to be saved
        case 'Save Changes':
                $i = filter_input(INPUT_POST, 'modifiedItemid', FILTER_VALIDATE_INT);
                $modified_Item = filter_input(INPUT_POST, 'modifiedItem');
                if (empty($modified_Item)) {
                $errors[] = 'The modified Item cannot be empty.';
                } elseif($i === NULL || $i === FALSE) {
                $errors[] = 'The Item cannot be modified.';
                } else {
                $Item_list[$i] = $modified_Item;
                $modified_Item = '';
                }
                break;

//Initiate when item is not edited and chosen to be cancelled   
        case 'Cancel Changes':
                $modified_Item = '';
                break;

//Initiate when item is sorted alphabetically 
        case 'Sort Items':

            $arrlength = count($Item_list);
            if ($arrlength < 2) {
                $errors[] = 'You need 2 or more items to sort items.';
                } else {
                    sort($Item_list);;
                } 
            break;     

}
include('Item_list.php');
?>
