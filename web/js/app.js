$(window).on('load', function () {
    $(".loader").fadeOut();
    $("#preloder").delay(200).fadeOut("slow");
});

if (document.URL == "http://localhost/quiz-school-teacher/") {
	$('#home').addClass('active');
} else if (document.URL == "http://localhost/quiz-school-teacher/home") {
	$('#home').addClass('active');
} else if (document.URL == "http://localhost/quiz-school-teacher/upload") {
	$('#upload').addClass('active');
} else if (document.URL == 'http://localhost/quiz-school-teacher/select-uploaded-test') {
	$('#info').addClass('active');
} else if (document.URL == 'http://localhost/quiz-school-teacher/select-students-result') {
	$('#view').addClass('active');
}