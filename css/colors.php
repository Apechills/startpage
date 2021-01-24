<?php
    header("Content-type: text/css");
    require("../php/loadColors.php");
?>

.c1_cl {
    color: <?php echo $C1 ?> !important;
}

.c1_bg {
    background-color: <?php echo $C1 ?> !important;
}

.c2_cl {
    color: <?php echo $C2 ?> !important;
}

.c2_bg {
    background-color: <?php echo $C2 ?> !important;
}

.c3_cl {
    color: <?php echo $C3 ?> !important;
}

.c3_bg {
    background-color: <?php echo $C3 ?> !important;
}

.c4_cl {
    color: <?php echo $C4 ?> !important;
}

.c4_bg {
    background-color: <?php echo $C4 ?> !important;
}

.c5_bg {
    background-color: <?php echo $C5 ?> !important;
}

.c5_cl {
    color: <?php echo $C5 ?> !important;
}

/*CUSTOM*/

.editInputWrapper input:focus {
    border-bottom: 4px solid <?php echo $C3 ?> !important;
}