function openNav() {
    $("#mySidenav").css("width", "100%");
}

function closeNav() {
    $("#mySidenav").css("width", "0");
}

$("#openSideNav").on("click", function () {
    openNav();
});

$(".closeSideNav").on("click", function () {
    closeNav();
});

// display message
$(".messages").delay(2500).fadeOut("slow");
