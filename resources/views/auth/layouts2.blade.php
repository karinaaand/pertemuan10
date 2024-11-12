<link rel="stylesheet" href="{{ asset('lightbox2/dist/css/lightbox.min.css')
}}">


<li class="nav-item">
    <a class="nav-link {{ (request()->is('gallery')) ? 'active' : '' }}" href="{{
   route('gallery.index') }}">Gallery</a>
   </li>


   <script src="{{ asset('lightbox2/dist/js/lightbox-plus-jquery.min.js')
   }}"></script>
