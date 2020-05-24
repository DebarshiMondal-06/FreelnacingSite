$("#save-btn-past-experience").on("click", () => {
    const company = $("#company").val();
    const title = $("#past-title").val();
    $("#past-experience").append("<h6><b>Company</b>: " + company + " | <b>Title:</b> " + title + "</h6>");
    $('#exampleModalLong').modal('hide');
});
$("#add-language").on("click", () => {
    $("#languages-column").append("<div class='input-group'><select class='form-control'><option value=''>Select Language</option><option value='hindi'>Hindi</option><option value='punjabi'>Punjabi</option><option value='bengoli'>Bengoli</option></select><select class='form-control'><option value=''>Select Proficiency</option><option value='basic'>Basic</option><option value='conversational'>Converstaionsal</option><option value='fluent'>Fluent</option></select></ div>")
});



$("#1").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#1a").addClass("active");
});
$("#2").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#2a").addClass("active");
});
$("#3").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#3a").addClass("active");
});
$("#4").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#4a").addClass("active");
});
$("#5").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#5a").addClass("active");
});
$("#6").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#6a").addClass("active");
});
$("#7").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#7a").addClass("active");
});
$("#8").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#8a").addClass("active");
});
$("#9").on("click" , () => {
    $("#myTab a").removeClass("active");
    $("#9a").addClass("active");
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
