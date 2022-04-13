<div id="cookie-banner">
  <div class="alert text-center bg-warning"
    style="z-index: 1;bottom: 0;margin-bottom: 0;position: fixed; width:100%; z-index: 1000" role="alert">
    @lang('blog.cookie_text')
    <button type="button" class="btn btn-primary btn-sm acceptcookies" onclick="accept()">
      @lang('blog.cookie_button_text')
    </button>
  </div>
</div>

<script>
  const accepted = JSON.parse(localStorage.getItem('cookiesAccepted'));
  if(accepted){
    accept();
  }
  function accept(){
    const el = document.getElementById('cookie-banner');
    el.classList.add('invisible');
  localStorage.setItem('cookiesAccepted', true);
  }
</script>