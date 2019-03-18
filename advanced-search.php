<?php
$query  = "SELECT DISTINCT listings.id, listings.time_from, listings.time_until FROM listings LEFT JOIN diet_listings ON listings.id = diet_listings.listing_id WHERE (listings.title LIKE CONCAT('%',?,'%') OR listings.description LIKE CONCAT('%',?,'%')) AND listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW()";
if (isset($_POST['allergen'])) {
    $i = 0;
    foreach ($_POST['allergen'] as $allergen) {
        if ($i == 0) {
            $allergens = $allergen;
        }
        else {
            $allergens .= ", ";
            $allergens .= $allergen;
        }
        $i++;
    }
    $query = "SELECT DISTINCT listings.id, listings.time_from, listings.time_until FROM listings LEFT JOIN diet_listings ON listings.id = diet_listings.listing_id WHERE listings.id NOT IN (SELECT DISTINCT id FROM listings JOIN allergen_listings ON listings.id = allergen_listings.listing_id WHERE allergen_listings.allergen_id IN (" . $allergens . ")) AND listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW() AND (listings.title LIKE CONCAT('%',?,'%') OR listings.description LIKE CONCAT('%',?,'%'))";
}
if ($_POST['portions'] == 'low') {
    $query .= " AND portions < 50";
}
elseif ($_POST['portions'] == 'medium') {
    $query .= " AND portions > 49 AND portions < 100";
}
elseif ($_POST['portions'] == 'high') {
    $query .= " AND portions > 99";
}
if (isset($_POST['diet'])) {
    $i = 0;
    foreach ($_POST['diet'] as $diet) {
        if ($i == 0) {
            $diets = $diet;
        }
        else {
            $diets .= ", ";
            $diets .= $diet;
        }
        $i++;
    }
    $query .= " AND diet_listings.diet_id IN (" . $diets . ")";
}
if ($_POST['sort-by'] == 'earliest') {
    $query .= " ORDER BY time_from";
}
elseif ($_POST['sort-by'] == 'latest') {
    $query .= " ORDER BY time_until DESC";
}
$search_funct = $conn->prepare($query);
$search_funct->bind_param("ss", $_POST['advanced-search'], $_POST['advanced-search']);
$search_funct->execute();
$result = $search_funct->get_result();