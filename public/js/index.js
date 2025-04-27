$('a').on("click", function(event) {
    event.preventDefault();
    const target = $(this).attr("href");
    $(targetId).slideToggle();
});