
var user = $("#user").val();
var color = "white";
// const interval;
// alert(user);
$(document).ready(function() {
  
    pollServer();
    $(".key").css('pointer-events', "none");
    checkAcquireControl( $("#user").val());
    setInterval(function() {
        checkAcquireControl( $("#user").val());
      }, 2000);
    // timePause(5000);
   
});

function pollServer() {
    $.ajax({
        type: "POST",
        url: "requests.php",
        data: {action: "fetch"},
        dataType: "json",
        success: function(response) {

            if(response.st){
                var data = response.data;
                $.each(data, function(key, value) {
                    $("#key"+value.id).css("background-color", value.color);
                    console.log(key + ": " + value);
                });
            }else{
                alert(response.msg);
            }
            
          
        },
        error: function(xhr, status, error) {
    
            console.error(error);
        }
    });
}

$(".key").click(function() {
    // alert(666);
    var user = $("#user").val();
    var color = this.style.backgroundColor
    if (this.style.backgroundColor != "white") {
        color = "white";
    }else{
        if (user == "1") {
            color = "red";
        } else {
            color = "yellow";
        }
    }
    this.style.backgroundColor = color;
    $(".key").css('pointer-events', "none");
    sendData($(this).data('id'), color)
});


$("#acquire-control").click(function() {
    var user = $("#user").val();
    acquireControl(user);

});

$("#reset").click(function() {
    $.ajax({
        type: "POST",
        url: "requests.php",
        data: {action:"reset"},
        dataType: "json",
        success: function(response) { 
            alert(response.msg);
        },
        error: function(xhr, status, error) {
    
            console.error(error);
        }
    });

});
    
function sendData(key, color) {
    $.ajax({
        type: "POST",
        url: "requests.php",
        data: {key: key, color: color,action:"update"},
        dataType: "json",
        success: function(response) { 
            if(response.st){
                pollServer();
                clearInterval(interval);
            }else{
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
    
            console.error(error);
        }
    });
}

function acquireControl(user) {
    $.ajax({
        type: "POST",
        url: "requests.php",
        data: {user: user, action:"acquireControl"},
        dataType: "json",
        success: function(response) { 
            if(response.st){
                pollServer();
                $(".key").css('pointer-events', "");
                timePause();

            }else{
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
    
            console.error(error);
        }
    });
}

function checkAcquireControl(user) {
    $.ajax({
        type: "POST",
        url: "requests.php",
        data: {user: user, action:"checkControlPause"},
        dataType: "json",
        success: function(response) { 
            if(response.st){
                //pollServer();
                var data = response.data;
                const countdown = $("#acquire-control");

                if(data.type != "aquired" && data.time == 0){
                    
                    countdown.html('Take Control');
                    countdown.attr('disabled', false);
                    pollServer();
                    
                }else{
                    countdown.html('Take Control');
                    countdown.attr('disabled', true);
                }
            }else{
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
    
            console.error(error);
        }
    });
}

function timePause(pause = 120000){
    const targetTime = new Date().getTime() + parseInt(pause); // Set the target time to one minute from now
    const countdown = $("#acquire-control");
    countdown.attr('disabled', true);
    

    interval = setInterval(() => {
        const remainingTime = targetTime - new Date().getTime();
        const seconds = Math.floor(remainingTime / 1000);

        if (seconds <= 0) {
            countdown.html('Take Control');
            $(".key").css('pointer-events', "none");
            clearInterval(interval);
        } else {
            countdown.html(`Wait: ${seconds} seconds`);
        }
    }, 1000); // Update the timer every second
}