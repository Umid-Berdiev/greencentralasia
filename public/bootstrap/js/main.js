var regions = {
  uz_an: {
    name: "Бошқарма бошлиғи – Хамидов Хушнудбек Собирович",
    phone: "374-223-55-44",
    email: "nq.havza@minwater.uz"
  },
  uz_na: {
    name: "Бошқарма бошлиғи - Худойбердиев Нуршод Нурмаматович",
    phone: "369-227-69-40",
    email: "ns.havza@minwater.uz"
  },
  uz_fa: {
    name: "Бошқарма бошлиғи - Рахматиллаев Азамжон ",
    phone: "373-244-67-83",
    email: "fv.havza@minwater.uz"
  },
  uz_ta: {
    name: "Бошқарма бошлиғи - Қурбонов Бахтиёр Дехқонович",
    phone: "371-295-01-03",
    email: "tv.havza@minwater.uz"
  },
  uz_si: {
    name: "Бошқарма бошлиғи - Исроилов Шавкат Отамуродович",
    phone: "367-225-00-30",
    email: "qs.havza@minwater.uz"
  },
  uz_ji: {
    name: "Бошқарма бошлиғи - Джураев Шухрат Суярқулович",
    phone: "372-226-90-04",
    email: "sz.havza@minwater.uz"
  },
  uz_sa: {
    name: "Бошқарма бошлиғи - Исантурдиев Бахадир Хусаинович",
    phone: "366-213-03-54",
    email: "zar.havza@minwater.uz"
  },
  uz_qa: {
    name: "Бошқарма бошлиғи - Рахимов Ботир",
    phone: "375-226-11-71",
    email: "aq.havza@minwater.uz"
  },
  uz_su: {
    name: "Бошқарма бошлиғи - Алимов Тўлқин Жўраевич",
    phone: "376-221-73-05",
    email: "as.havza@minwater.uz"
  },
  uz_bu: {
    name: "Бошқарма бошлиғи-Қодиров Олим Зоирович",
    phone: "365-225-09-35",
    email: "ab.havza@minwater.uz"
  },
  uz_nv: {
    name: "Бошқарма бошлиғи- Атақулов Нуркамол Умарович",
    phone: "436-532-34-60",
    email: "qz.havza@minwater.uz"
  },
  uz_xo: {
    name: "Бошқарма бошлиғи -Тоиров Одилбек Рахимберганович",
    phone: "362-223-14-05",
    email: "xz.havza@minwater.uz"
  },
  uz_qo: {
    name: "Узақов Жалғас Узақович  - вазир",
    phone: "361-224-29-37",
    email: "qqr@minwater.uz"
  },
  uz_tk: {
    name: "Ибрагимов Мухаммаджон Халиллаевич - Ташкилий-назорат ва таҳлил бошқармаси бошлиғи",
    phone: "(98871) 237-24-26",
    email: "mmm@minwater.uz"
  }
};




$(document).ready(function () {
  document.cookie = "voice=on";
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

  $(document).mouseup(function (e){ // attach the mouseup event for all div and pre tags
    setTimeout(function() { // When clicking on a highlighted area, the value stays highlighted until after the mouseup event, and would therefore stil be captured by getSelection. This micro-timeout solves the issue.
     if(readCookie("voice") == "off" ||readCookie("voice") == null )
     {
       responsiveVoice.cancel(); // stop anything currently being spoken
     }
     else
     {
       responsiveVoice.cancel(); // stop anything currently being spoken
       responsiveVoice.speak(getSelectionText(), "Russian Female"); //speak the text as returned by getSelectionText
     }

    }, 1);
  });


  $(".voices").click(function () {
    if(readCookie("voice") == null || readCookie("voice") == 'off')
    {
      document.cookie = "voice=on";
    }
    else
    {
      document.cookie = "voice=off";

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
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }

  if(readCookie("spec") == "off" ||readCookie("spec") == null )
  {

    $(".special-settings").css("display", "none");
    $("body").css("filter", "grayscale(0)");
  }
  else
  {
    $(".special-settings").css("display", "block");
    $("body").css("filter", "grayscale(1)");
  }
  $(".specialversion").click(function () {
     if(readCookie("spec") == null || readCookie("spec") == 'off')
     {
       document.cookie = "spec=on";
       window.location.reload();

     }
     else
     {
       document.cookie = "spec=off";
       window.location.reload();
     }


  });

  $(".up").click(function () {
    $("p, h6, h5, h4, h3, h2, h1, a").animate({"font-size": "+=2"});
  });

  $(".down").click(function () {
    $("p, h6, h5, h4, h3, h2, h1, a").animate({"font-size": "-=2"});
  });

  $(".black").click(function () {
    $("*").css({"background-color": "#fff", "color": "#000"});
  });

  $(".yellow").click(function () {
    $("*").css({"background-color": "#000", "color": "#ff0"});
  });
  
});
