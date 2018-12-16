<!DOCTYPE html>
<html lang="en">
  <head>
  @extends('includes.header')  
  </head>
  <?php 
  $classbody = '';
  ?>

@auth
    <?php  $classbody= 'header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show'; ?>
@endauth

@guest
    <?php  $classbody= 'flex-row align-items-center'; ?>
@endguest



  <body class="app {{ $classbody }}" style="opacity: 0;">
    @extends(Auth::user() ? 'includes.topmenu' : 'includes.empty')

      @yield('contentlogin')



@auth
    <?php   echo '<div class="app-body">'; ?>
@endauth
          @extends(Auth::user() ? 'includes.sidebar' : 'includes.empty')
          @yield('content')
@auth
    <?php   echo '</div>'; ?>
@endauth

  @yield('modal')
  @extends(Auth::user() ? 'includes.bottom' : 'includes.empty')
  <script src="public/node_modules/jquery/dist/jquery.min.js"></script>
  @extends('includes.footer')
  </body>

</html>

@yield('script')

<script type="text/javascript">

/* eslint-disable no-magic-numbers */
$( document ).ready(function() {
 $('body').css('opacity','1');
 $('.container').css('opacity','1');
 
}); 

</script>

