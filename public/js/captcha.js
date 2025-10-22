var captchaStatus = 0;
    var validationResult = 0;

    
function getCaptcha(){

    var captcha = document.querySelector(".captcha");
    captcha.innerText = "";
    
    var num1, num2;

    do {
        num1 = Math.floor(Math.random() * 10);
    } while (num1 === 0);

    do {
        num2 = Math.floor(Math.random() * 10);
    } while (num2 === 0);

    var validationResult = (+num1) + (+num2);

    let randomCharacter = num1+" + "+num2;
    captcha.innerText += randomCharacter; //passing 6 random characters inside captcha innerText

    return validationResult;

}

    function removeContent(){

        var inputField = document.querySelector("#captchavalueinput");
        var captcha = document.querySelector(".captcha");
        var statusTxt = document.querySelector(".status-text");

        inputField.value = "";
        captcha.innerText = "";
        statusTxt.style.display = "none";

        validationResult = getCaptcha();
    }


    function recaptchaChange()
    {
        removeContent();
        validationResult = getCaptcha();
    }

    function validateCaptcha()
    {
        var statusTxt = document.querySelector(".status-text");
        var inputField = document.querySelector("#captchavalueinput");
                
                statusTxt.style.display = "block";
                let inputVal = inputField.value;

                console.log(inputVal);
                if(inputVal == ''){ 
                    statusTxt.innerText = "";
                    statusTxt.style.display = "none";
                    captchaStatus = 0;
                }else
                if(inputVal == validationResult){ //if captcha matched
                    statusTxt.style.color = "#3eb306";
                    statusTxt.innerText = "Capthcha Verification complete. You may proceed.";
                    captchaStatus = 1;
                }else{
                    statusTxt.style.color = "#ed0707";
                    statusTxt.innerText = "Captcha not matched. Please try again!";
                    captchaStatus = 0;
                }

        return captchaStatus;
                
    }


    $(document).ready(function() {

        validationResult = getCaptcha(); 

    });