@extends('frontend.bigbag.index')
@section('content')
 
    <section class="bg-light bg-login py-5">


     
        <section class="login-block mt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 login-sec">

                        <div class="li-product-tab li-trending-product-tab">
                            <ul class="nav li-product-menu li-trending-product-menu">
                                <li><a class="active" data-toggle="tab" href="#signin"><span>{{ __('Sign in') }}</span></a></li>
                                <li><a data-toggle="tab" href="#signup"><span>{{ __('sign up') }}</span></a></li>
                            </ul>
                        </div>


                        <div class="tab-content li-tab-content li-trending-product-content">
                            <div id="signin" class="tab-pane show fade in active">
                                <div class="row">
      
                                    <div class="col">
                                        <form class="login-form" action="{{ url('user/login') }}" method="POST">
                                        	@csrf
                                            <div class="form-group">
             <input type="text" class="form-control"
                                                    placeholder="{{ __('Mobile Number Or Email') }}" name="email" required="">

                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="{{ __('Password') }}"  name="password" required="">
                                            </div>


                                            <div class="form-check">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">{{ __('Remember me') }}</label>
                                                </div>

                                            </div>
                                            <label for="" class="float-right">

                                                <a href="{{url('/')}}/password/reset"  >{{ __('Forget Password ?') }}</a>
                                            </label>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-login">{{ __('Login') }}</button>
                                            </div>
                                        </form>

                                    
                          <a href="/guestCheckout" class="btn btn-login">{{ __('Login As Guest') }}</a>
                                          
                                        <h6 class="line"><span class="line-center">{{ __('OR') }}</span></h6>
                                        <div class="social-btns">
                                            <a href="#" class="fb btn">
                                                <i class="fab fa-facebook fa-fw"></i> {{ __('Login with Facebook') }}
                                            </a>
                                            <a href="#" class="google btn"><i class="fab fa-google fa-fw">
                                                </i> {{ __('Login with Google') }}
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="signup" class="tab-pane show fade in">
                                <div class="row">
                                    <div class="col">
                                        <form class="login-form" action="{{ url('/user/register-user') }}" method="POST" >
                                        	  @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('Name') }}" name="name" required="">

                                                    </div>
                                                </div>
                                                 
                                            </div>
                                            <!--div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{ __('Mobile Number') }}">

                                            </div -->
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{ __('Email') }}" name="email" required="">

                                            </div>

                                             <div class="form-group">
                                                <input type="number" class="form-control" placeholder="{{ __('phone') }}" name="phone" required="">

                                            </div>


                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="{{ __('Password') }}" name="password" required=""
                                                     id="pass1" onkeyup="checkPass(); return false;" />
                                             <div id="error-nwl"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                    placeholder="{{ __('Confrim Password') }}" required=""  id="pass2" onkeyup="checkPass(); return false;" >
                                            </div>
                                            <small>{{ __('By Creating An Account, You Agree To Receive Sms From Our Website.') }}</small>

                                             <br>
                                            <div class="form-check">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" required="">
                                                    <label class="form-check-label" for="exampleCheck1">
                                                        <a href="{{url('/')}}/Terms_and_Conditions" target="_blank">{{__('Terms and Conditions')}} </a>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <button   type="submit" class="btn btn-login">{{ __('Signup') }}</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <h3 class="text-center">Forget Password</h3>
                            <hr>
                            <p>Please type your email to reset your password</p>
                            <form action="">
                                
                                <div class="form-group">
                                   <input type="text" class="form-control" placeholder="Email">
                                </div>
                                <a href="#" class="btn btn-solid">Send</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

  <br>
  <br>
    @push('js')
           <script type="text/javascript">
               function checkPass()
{
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    var message = document.getElementById('error-nwl');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    
    if(pass1.value.length > 7)
    {
        pass1.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "{{__('character number ok!')}}"
    }
    else
    {
        pass1.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "{{__('you have to enter at least 8 digit!')}}"
        return;
    }
  
    if(pass1.value == pass2.value)
    {
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "ok!"
    }
    else
    {
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "These passwords don't match"
    }
}  
           </script>
    @endpush

@endsection
