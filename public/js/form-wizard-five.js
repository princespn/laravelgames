(function ($) {
  (function (a) {
    a.fn.smartWizard = function (m) {
      var c = a.extend({}, a.fn.smartWizard.defaults, m),
        x = arguments;
      return this.each(function () {
        function C() {
          var e = b.children("div");
          b.children("ul").addClass("anchor");
          e.addClass("content");
          n = a("<div>Loading</div>").addClass("loader");
          k = a("<div></div>").addClass("action-bar");
          p = a("<div></div>").addClass("step-container login-card");
          q = a("<a>" + c.labelNext + "</a>")
            .attr("href", "#")
            .addClass("btn btn-primary")
            .attr("id", "nextButton")
            .attr("onclick", "onClickButtonTypeHandle('next')");
          r = a("<a>" + c.labelPrevious + "</a>")
            .attr("href", "#")
            .addClass("btn btn-primary")
            .attr("id", "previousButton")
            .attr("onclick", "onClickButtonTypeHandle('previous')");  
          s = a("<a>" + c.labelFinish + "</a>")
            .attr("href", "#")
            .addClass("btn btn-primary")
            .attr("id", "finishButton")
            .attr("onclick", "onClickButtonTypeHandle('finish')");
          c.errorSteps &&
            0 < c.errorSteps.length &&
            a.each(c.errorSteps, function (a, b) {
              y(b, !0);
            });
          p.append(e);
          k.append(n);
          b.append(p);
          b.append(k);
          c.includeFinishButton && k.append(s);
          k.append(q).append(r);
          z = p.width();
          a(q).click(function () {
            if (a(this).hasClass("buttonDisabled")) return !1;
            A();
            return !1;
          });
          a(r).click(function () {
            if (a(this).hasClass("buttonDisabled")) return !1;
            B();
            return !1;
          });
          a(s).click(function () {
            if (!a(this).hasClass("buttonDisabled"))
              if (a.isFunction(c.onFinish)) c.onFinish.call(this, a(f));
              else {
                var d = b.parents("form");
                d && d.length && d.submit();
              }
            return !1;
          });
          a(f).bind("click", function (a) {
            if (f.index(this) == h) return !1;
            a = f.index(this);
            1 == f.eq(a).attr("isDone") - 0 && t(a);
            return !1;
          });
          c.keyNavigation &&
            a(document).keyup(function (a) {
              39 == a.which ? A() : 37 == a.which && B();
            });
          D();
          t(h);
        }

        function D() {
          c.enableAllSteps
            ? (a(f, b)
                .removeClass("selected")
                .removeClass("disabled")
                .addClass("done"),
              a(f, b).attr("isDone", 1))
            : (a(f, b)
                .removeClass("selected")
                .removeClass("done")
                .addClass("disabled"),
              a(f, b).attr("isDone", 0));
          a(f, b).each(function (e) {
            a(a(this).attr("href"), b).hide();
            a(this).attr("rel", e + 1);
          });
        }

        function t(e) {
          var d = f.eq(e),
            g = c.contentURL,
            h = d.data("hasContent");
          stepNum = e + 1;
          g && 0 < g.length
            ? c.contentCache && h
              ? w(e)
              : a.ajax({
                  url: g,
                  type: "POST",
                  data: {
                    step_number: stepNum,
                  },
                  dataType: "text",
                  beforeSend: function () {
                    n.show();
                  },
                  error: function () {
                    n.hide();
                  },
                  success: function (c) {
                    n.hide();
                    c &&
                      0 < c.length &&
                      (d.data("hasContent", !0),
                      a(a(d, b).attr("href"), b).html(c),
                      w(e));
                  },
                })
            : w(e);
        }

        function w(e) {
          var d = f.eq(e),
            g = f.eq(h);
          if (
            e != h &&
            a.isFunction(c.onLeaveStep) &&
            !c.onLeaveStep.call(this, a(g))
          )
            return !1;
          c.updateHeight && p.height(a(a(d, b).attr("href"), b).outerHeight());
          if ("slide" == c.transitionEffect)
            a(a(g, b).attr("href"), b).slideUp("fast", function (c) {
              a(a(d, b).attr("href"), b).slideDown("fast");
              h = e;
              u(g, d);
            });
          else if ("fade" == c.transitionEffect)
            a(a(g, b).attr("href"), b).fadeOut("fast", function (c) {
              a(a(d, b).attr("href"), b).fadeIn("fast");
              h = e;
              u(g, d);
            });
          else if ("slideleft" == c.transitionEffect) {
            var k = 0;
            e > h
              ? ((nextElmLeft1 = z + 10),
                (nextElmLeft2 = 0),
                (k = 0 - a(a(g, b).attr("href"), b).outerWidth()))
              : ((nextElmLeft1 =
                  0 - a(a(d, b).attr("href"), b).outerWidth() + 20),
                (nextElmLeft2 = 0),
                (k = 10 + a(a(g, b).attr("href"), b).outerWidth()));
            e == h
              ? ((nextElmLeft1 = a(a(d, b).attr("href"), b).outerWidth() + 20),
                (nextElmLeft2 = 0),
                (k = 0 - a(a(g, b).attr("href"), b).outerWidth()))
              : a(a(g, b).attr("href"), b).animate(
                  {
                    left: k,
                  },
                  "fast",
                  function (e) {
                    a(a(g, b).attr("href"), b).hide();
                  }
                );
            a(a(d, b).attr("href"), b).css("left", nextElmLeft1);
            a(a(d, b).attr("href"), b).show();
            a(a(d, b).attr("href"), b).animate(
              {
                left: nextElmLeft2,
              },
              "fast",
              function (a) {
                h = e;
                u(g, d);
              }
            );
          } else
            a(a(g, b).attr("href"), b).hide(),
              a(a(d, b).attr("href"), b).show(),
              (h = e),
              u(g, d);
          return !0;
        }

        function u(e, d) {
          a(e, b).removeClass("selected");
          a(e, b).addClass("done");
          a(d, b).removeClass("disabled");
          a(d, b).removeClass("done");
          a(d, b).addClass("selected");
          a(d, b).attr("isDone", 1);
      
          // Update button states based on the current step
          var stepIndex = d.attr("rel"); // Get the current step number
          console.log(stepIndex);
          console.log(h);
          console.log(f.length);
          if (stepIndex == 3) {
              a(q).addClass("buttonDisabled"); // Disable the 'Next' button on step 3
              a(s).removeClass("buttonDisabled"); // Show and enable the 'Finish' button on step 3
          } else {
              a(q).removeClass("buttonDisabled"); // Ensure 'Next' button is enabled on other steps
              if (!c.cycleSteps) {
                  stepIndex == 1 ? a(r).addClass("buttonDisabled") : a(r).removeClass("buttonDisabled");
                  stepIndex == f.length ? a(q).addClass("buttonDisabled") : a(q).removeClass("buttonDisabled");
              }
              a(s).addClass("buttonDisabled"); // Hide and disable the 'Finish' button on other steps
          }
          
          console.log(a(r));
          console.log(a(q));
          console.log(a(s));

          c.cycleSteps ||
          (0 >= h
              ? a(r).addClass("buttonDisabled")
              : a(r).removeClass("buttonDisabled"),
          f.length - 2 <= h
              ? a(q).addClass("buttonDisabled")
              : a(q).removeClass("buttonDisabled"));
          if (stepIndex == 3)
              a(s).removeClass("buttonDisabled");
          else
              a(s).addClass("buttonDisabled");
          if (a.isFunction(c.onShowStep) && !c.onShowStep.call(this, a(d)))
              return !1;
      }

        function A() {
          var a = h + 1;
          if (f.length <= a) {
            if (!c.cycleSteps) return !1;
            a = 0;
          }
          t(a);
        }

        function B() {
          var a = h - 1;
          if (0 > a) {
            if (!c.cycleSteps) return !1;
            a = f.length - 1;
          }
          t(a);
        }

        function E(b) {
          a(".content", l).html(b);
          l.show();
        }

        function y(c, d) {
          d
            ? a(f.eq(c - 1), b).addClass("error")
            : a(f.eq(c - 1), b).removeClass("error");
        }
        var b = a(this),
          h = c.selected,
          f = a("ul > li > a[href^='#step-']", b),
          z = 0,
          n,
          l,
          k,
          p,
          q,
          r,
          s;
        k = a(".action-bar", b);
        0 == k.length && (k = a("<div></div>").addClass("action-bar"));
        l = a(".msg-box", b);
        0 == l.length &&
          ((l = a(
            '<div class="msg-box"><div class="content"></div><a href="#" class="close"><i class="icofont icofont-close-line-circled"></i></a></div>'
          )),
          k.append(l));
        a(".close", l).click(function () {
          l.fadeOut("normal");
          return !1;
        });
        if (m && "init" !== m && "object" !== typeof m) {
          if ("showMessage" === m) {
            var v = Array.prototype.slice.call(x, 1);
            E(v[0]);
            return !0;
          }
          if ("setError" === m)
            return (
              (v = Array.prototype.slice.call(x, 1)),
              y(v[0].stepnum, v[0].iserror),
              !0
            );
          a.error("Method " + m + " does not exist");
        } else C();
      });
    };
    a.fn.smartWizard.defaults = {
      selected: 0,
      keyNavigation: !0,
      enableAllSteps: !1,
      updateHeight: !0,
      transitionEffect: "fade",
      contentURL: null,
      contentCache: !0,
      cycleSteps: !1,
      includeFinishButton: !0,
      enableFinishButton: !1,
      errorSteps: [],
      labelNext: "Next",
      labelPrevious: "Previous",
      labelFinish: "Finish",
      onLeaveStep: null,
      onShowStep: null,
      onFinish: null,
    };
  })(jQuery);

  $("#wizard").smartWizard({
    transitionEffect: "slideleft",
    onFinish: onFinishCallback,
    onLeaveStep: onLeaveStepCallback,
  });


 
  

  function onLeaveStepCallback(obj, context) {

        var selectedElement = $('.selected');
        console.log(buttonType);
        
        if(selectedElement.attr('rel') == 1)
        {
          var errorText = $("#lname_invalid").text().trim();
            
          if($('#lname').val() == "")
          {
              $('#lname_invalid').html("First Enter Valid Invitation Code...");
              return false;
          }
          else if (errorText !== "") {
              $('#lname_invalid').html("First Enter Valid Invitation Code...");
              return false;
          }
          else{
            $('#lname_invalid').html("");
            $('#ref_user_id_view_part').val($('#lname').val());
            return true; 
          }
        }
        else if(selectedElement.attr('rel') == 2){
          if(buttonType == "next")
          {
          var chk = 0;
          var errorText1 = $("#emailerr").text().trim();  
          if($('#email').val() == "")
            {
                  $('#emailerr').html("First Enter Valid Email ID...");
                  return false;
            }
            else if (errorText1 !== "") {
                  $('#emailerr').html("First Enter Valid Email ID...");
                  return false;
            }
            else{
              $('#emailerr').html("");
              var errTextSelectionOfPosition = $('#errs_id').text().trim();
              if($('#s_id').val() == "")
                {
                      $('#errs_id').html("First Select Valid Position...");
                      return false;
                }
                else{
                  $('#errs_id').html("");

                  if($('#mobile').val() == "" || $('#mobile').val().length < 5)
                    {
                      $('#mobile_err').html("Please enter valid whatsapp number ...");
                      return false;
                    }
                    else{
                      $('#mobile_err').html("");
                  
                  $('#errExampleInputPassword1').html("");
                  if($('#passmatchpercent').val() < 100)
                    {
                          $('#errExampleInputPassword1').html("Password Must Be with Maximum Strength...");
                          return false;
                    }
                    else{
                      $('#errExampleInputPassword1').html("");
                      
                      //call function to send otp on mail
                      if($('#full_name').val() == "" || $('#full_name').val().length < 4)
                      {
                        $('#full_name_err').html("Please enter valid full name ...");
                        return false;
                      }
                      else{
                        $('#full_name_err').html("");                      
                      $.ajax({
                          url: $('#baseurlinput').val()+"/sendRegistrationOtpOnMail",
                          type: "POST",
                          dataType: "json",
                          headers: {
                              "X-CSRF-TOKEN": csrf_token
                          },
                          data: {
                              emailid: $('#email').val()
                          },
                          success: function(data) {
                              if (data.code == 200) {
                                toastr.success("OTP sent on your Email-ID.");
                              }
                          }
                      });
                      
                      return true;
                    }
                      
                    }

                  }
                }
            }
          }
          else{
            return true;
          }

        }
        else if(selectedElement.attr('rel') == 3){
          return true; 
        }
        
        
        
        
        

        
    }

    function goToStep(stepNumber) {
      var $wizard = $("#wizard");  // Adjust this selector to target your specific wizard
      var $steps = $wizard.find("ul > li > a[href^='#step-']");  // Find all step anchors
      var $currentStep = $wizard.find("ul > li > a.selected");  // Get the currently selected step
      var currentIndex = $steps.index($currentStep);
      var targetIndex = stepNumber - 1;  // Zero-based index
      var $allButton = $wizard.find('a.btn-primary[href="#"]');  // Selector for the 'Next' button
      
  
      if (currentIndex === targetIndex) {
          return;  // Already on the desired step
      }
  
      // Logic to navigate directly to a specific step:
      $steps.removeClass('selected').eq(targetIndex).addClass('selected');
      $wizard.find('.content').hide().eq(targetIndex).show();

      $allButton.addClass('buttonDisabled');  // Disable the 'Next' button
        
      // You might need to manually handle enabling/disabling of next/previous buttons
      // and triggering any onLeaveStep or onShowStep callbacks
  }
  
  

    function onFinishCallback() {
      if(captchavalidationsuccess == 1) {

        var $wizard = $("#wizard");
        var $allButton = $wizard.find('a.btn-primary[href="#"]');  // Selector for the 'Next' button
        $allButton.addClass('buttonDisabled');  // Disable the 'Next' button
          var otp = $('#otp').val();
          if(otp == "" || otp.length < 6)
          {
              $('#errExampleInputOTPNo').html("");
              $('#errExampleInputOTP').html("Please Enter Valid OTP");
          }
          else{
            $('#errExampleInputOTP').html("");
            $('#errExampleInputOTPNo').html("You're more than just code!");
            $.ajax({
                url: base_url + "/registerUser",
                type: "POST",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrf_token
                },
                data: {
                  ref_user_id: $('#lname').val(),
                  country: $('#country').val(),
                  mobile: $('#mobile').val(),
                  email: $('#email').val(),
                  password: $('#exampleInputPassword1').val(),
                  position: $('#s_id').val(), 
                  otp: $('#otp').val(),
                  fullname: $('#full_name').val()
                },
                success: function(data) {
                    if (data.code == 200) {
                        $('#generated_userid').html(data.data.userid);
                        $('#entered_passwrd').html(data.data.password);
                        goToStep(4);
                        $("#wizard").smartWizard("showMessage", "Congratulations All steps are completed.");
                    } else {
                      $('#errExampleInputOTP').html(data.message);
                      // Enable the first and third buttons by removing the 'buttonDisabled' class
                      $allButton.eq(0).removeClass('buttonDisabled'); // First button (index 0)
                      $allButton.eq(2).removeClass('buttonDisabled'); // Third button (index 2)
                    }
                }
            });
           
          }
      } else {
          $("#wizard").smartWizard("showMessage", "Captcha validation failed. Please try again.");
      }
  }


 

  



})(jQuery);
