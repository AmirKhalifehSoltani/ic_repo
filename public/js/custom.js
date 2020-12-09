jQuery(document).ready(function () {
    $('.select2').select2();


    // $('input[id^="switchId-"]').each().onchange(function () {
    // $('#switchId-275').onchange(function () {
    //     alert(1234);
    //     this.disable();
    // });
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchId = html.id;
        var btnId = switchId.split('-')[1];
        // var switcheryVarName = 'switchery' + btnId;
        // this['switcheryVarName' + btnId] = new Switchery(html);

        var switchery = new Switchery(html);
        // console.log(switchery);
        // switchery.onchange = function () {
        //     // console.log(this);
        //     switchery.disable();
        //     // this['switcheryVarName'].disable();
        // }
    });


    // var changedSwitch = document.querySelector('.js-switch');
    // changedSwitch.onchange = function () {
    //     switchery.disable();
    // }
});

// show current date on site
var currentDate = new persianDate().format('YYYY/M/D');
document.getElementById('current-date').innerHTML = currentDate;

// data table initialize for all table
$('#admin_users_table').DataTable();

// var elem = document.querySelector('.js-switch');
// var init = new Switchery(elem);


// initialize icheck was commented (deactivated) in core.js on line 377 line

$('input[id^="switchId-"]').change(function () {

    console.log(this);
    // $(function() {
        enable_cb();
        $(this).click(enable_cb);
    // });

    function enable_cb() {
        if (this.checked) {
            $(this).removeAttr("disabled");
        } else {
            $(this).attr("disabled", true);
        }
    }



    var switchBtnId = this.id;
    var btnId = switchBtnId.split('-')[1];
    var switchCmd;
    if (this.checked == true) {
        switchCmd = 1;
        switchCmdName = 'روشن';
    } else if (this.checked == false) {
        switchCmd = 0;
        switchCmdName = 'خاموش';
    }
    $.ajax({
        url: 'sendcmd',
        type: 'post',
        dataType: 'json',
        data: {
            btnId: btnId,
            switchCmd: switchCmd
        },
        success: function (response) {
            if (response.success) {
                setTimeout(function () {
                    $.ajax({
                        url: 'getstatus',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            btnId: btnId
                        },
                        success: function (response) {
                            if (response.success){
                                if (response.status == switchCmd) {
                                    alert('دستگاه با موفقیت ' + switchCmdName + ' شد.');
                                } else {
                                    alert('دستگاه ' + switchCmdName + ' نشد.');
                                }
                            }
                        },
                        error: function () {

                        }
                    });
                }, 5000)
            }
        },
        error: function () {

        }
    });
});