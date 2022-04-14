$(document).ready(function () {
  if (readCookie("voice") == null) {
    document.cookie = "voice=on;expires=" + setTimeForCookies(60) + "; path=/";
  }
  if (readCookie("spec") == null) {
    document.cookie = "spec=off;expires=" + setTimeForCookies(60) + "; path=/";
  }

  function getSelectionText() {
    var text = "";
    if (window.getSelection) {
      text = window.getSelection().toString();
      // for Internet Explorer 8 and below. For Blogger, you should use &amp;&amp; instead of &&.
    } else if (document.selection && document.selection.type != "Control") {
      text = document.selection.createRange().text;
    }
    return text;
  }

  $(document).mouseup(function (e) {
    // attach the mouseup event for all div and pre tags
    setTimeout(function () {
      // When clicking on a highlighted area, the value stays highlighted until after the mouseup event, and would therefore stil be captured by getSelection. This micro-timeout solves the issue.
      if (readCookie("voice") == "off") {
        responsiveVoice.cancel(); // stop anything currently being spoken
      } else {
        responsiveVoice.cancel(); // stop anything currently being spoken
        responsiveVoice.speak(getSelectionText(), "Russian Female"); //speak the text as returned by getSelectionText
      }
    }, 1);
  });

  $(".specialversion").click(function () {
    setTimeout(function () {
      if (readCookie("spec") == "off") {
        document.cookie =
          "spec=on;expires=" + setTimeForCookies(120) + "; path=/";
        window.location.reload();
      } else {
        document.cookie =
          "spec=off;expires=" + setTimeForCookies(120) + "; path=/";
        window.location.reload();
      }
    }, 1);
  });

  $("#normalversion").click(function () {
    setTimeout(function () {
      document.cookie =
        "spec=off;expires=" + setTimeForCookies(120) + "; path=/";
      window.location.reload();
    }, 1);
  });

  $(".voices").click(function () {
    if (readCookie("voice") == "off") {
      document.cookie =
        "voice=on; expires=" + setTimeForCookies(120) + "; path=/";
      window.location.reload();
    } else {
      document.cookie =
        "voice=off; expires=" + setTimeForCookies(120) + "; path=/";
      window.location.reload();
    }
  });

  $("#myselect").change(function () {
    var selectedOption = $("#myselect option:selected").val();
    $("#name").text(regions[selectedOption].name);
    $("#phone").text(regions[selectedOption].phone);
    $("#email").text(regions[selectedOption].email);
    $(".map-highlight").css("fill", "#3d7c9d");
    $("#" + selectedOption).css("fill", "#d01a20");
  });

  $("path").click(function () {
    var mySelectedArea = this.id;
    $(".map-highlight").css("fill", "#3d7c9d");
    $("#" + mySelectedArea).css("fill", "#d01a20");
    $("#name").text(regions[mySelectedArea].name);
    $("#phone").text(regions[mySelectedArea].phone);
    $("#email").text(regions[mySelectedArea].email);
    $("#myselect").val(mySelectedArea);
  });

  function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  function setTimeForCookies(minutes) {
    var now = new Date();
    var time = now.getTime();

    time += minutes * 60 * 1000;
    now.setTime(time);
    return now;
  }

  if (readCookie("spec") == "off") {
    $(".special-settings").css("display", "none");
    $("body").css("filter", "grayscale(0)");
  } else {
    $(".special-settings").css("display", "block");
    $("body").css("filter", "grayscale(1)");
  }

  $(".up").click(function () {
    $("p, h6, h5, h4, h3, h2, h1, a").animate({ "font-size": "+=2" });
  });

  $(".down").click(function () {
    $("p, h6, h5, h4, h3, h2, h1, a").animate({ "font-size": "-=2" });
  });

  $(".black").click(function () {
    $("*").css({ "background-color": "#fff", color: "#000" });
  });

  $(".yellow").click(function () {
    $("*").css({ "background-color": "#000", color: "#ff0" });
  });
});
