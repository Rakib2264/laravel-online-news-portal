<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{route('front.index')}}"><h2>Rakib Blog<em>.</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('front.index')}}">{{__("Home")}}
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html"> {{__("About Us")}}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('front.all_post')}}">{{__("Post Details")}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.contact')}}">{{__("Contact Us")}}</a>
            </li>
          </ul>

        </div>
<div class="switch-launguage" id="switch_lan_form">
    <form  method="get">

        <select name="lang" class="form-select form-select-sm" id="switch_lan">

             <option value="en">EN</option>
             <option value="bn">BN</option>

        </select>
    </form>
</div>
      </div>
    </nav>
  </header>
  @push('js')
  <script>
    jQuery(document).ready(function() {

        // Set the initial value based on local storage
        if(localStorage.lang === 'bn'){
            jQuery('#switch_lan').val('bn');
        } else {
            jQuery('#switch_lan').val('en');
        }

        jQuery(document).on("change", "#switch_lan", function(e) {
            e.preventDefault();

            // Save the selected language in local storage
            localStorage.lang = $(this).val();

            // Submit the form
            jQuery("#switch_lan_form form").submit();
        });
    });
</script>

  @endpush
