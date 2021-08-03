let id = $("input[name*='id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
    let textvalues = displayData(e);


    let employeename = $("input[name*='employee_name']");
    let registrationcode = $("input[name*='reg_code']");
    let mobilenumber = $("input[name*='mobile_number']");
    let address = $("input[name*='address_']");
    let station = $("input[name*='station_']");
    let division = $("input[name*='division_']");
    let coursename = $("input[name*='course_name']");

    id.val(textvalues[0]);
    employeename.val(textvalues[1]);
    registrationcode.val(textvalues[2]);
    mobilenumber.val(textvalues[3]);
    address.val(textvalues[4]);
    station.val(textvalues[5]);
    division.val(textvalues[6]);
    coursename.val(textvalues[7]);
});

function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.id == e.target.dataset.id){
            textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}