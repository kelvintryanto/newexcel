<!DOCTYPE html> 
<html lang="{{ app()->getLocale() }}"> 
<head> 
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <title>PT. Mandiri Konsultama Perkasa</title> 
    <style> 
    body,html{ 
        margin: 0; 
        padding: 0; 
        height: 100vh; 
    } 
    .backGroundColor{ 
        width: 100%; 
        height: 100%; 
        background: linear-gradient(to bottom, #ffffff -6%, #006cff 100%); 
        display: table; 
    } 
    .logoTable{ 
        width: 55%; 
        height: 100vh; 
        display: table-cell;  
        vertical-align: middle; 
        padding: 0; 
        margin: 0; 
    } 

    .loginTable{ 
        width: 45%; 
        height: 100vh; 
        display: table-cell; 
        vertical-align: middle; 
        text-align: center; 
    } 

    .tabelLogin{ 
        width: 50%; 
        height: wrap; 
        background-color: #FFFFFF; 
        display: block; 
        margin: auto; 
        text-align: center;  
    } 

    body {font-family: Arial;} 

    /* Style the tab */ 
    .tab { 
        overflow: hidden; 
        border: 1px solid #ccc; 
        background-color: #f1f1f1; 
        width: 100%; 
    } 

    /* Style the buttons inside the tab */ 
    .tab button { 
        background-color: inherit; 
        float: left; 
        border: none; 
        outline: none; 
        cursor: pointer; 
        padding: 14px 16px; 
        transition: 0.3s; 
        font-size: 17px; 
        width: 100%; 
    } 

    /* Change background color of buttons on hover */ 
    .tab button:hover { 
        background-color: #ddd;      
    } 

    /* Create an active/current tablink class */ 
    .tab button.active { 
        background-color: #ccc; 
    } 

    /* Style the tab content */ 
    .tabcontent { 
        display: none; 
        padding: 6px 12px; 
        border: 1px solid #ccc; 
        border-top: none; 
    } 

</style> 
</head> 
<body> 
    <div class="backGroundColor"> 

        <div class="logoTable"> 

            <div class="middle"> 
                <table style="padding-left: 100px;"> 
                    <tr> 
                        <th rowspan="2"><img src="mkp-icon.png" style="padding-right: 50px;"></th> 
                        <td style="padding: 0px; margin: 0px; font-size: 30px;">PT. MANDIRI KONSULTAMA PERKASA</td> 
                    </tr> 
                    <tr> 
                        <td style="padding: 0px; margin: 0px; font-size: 30px;">PAYROLL SYSTEM</td> 
                    </tr> 
                </table> 
            </div> 
        </div> 

        <div class="loginTable"> 
            <div class="tabelLogin"> 
                <table style="width: 100%; text-align: center;"> 
                    <tr> 
                        <th colspan="2" style="padding: 10px;">Login</th> 
                    </tr> 
                    <tr class="tab"> 
                        <th><button class="tablinks" onclick="openTab(event, 'Karyawan')" id="defaultOpen">Karyawan</button></th> 
                        <th><button class="tablinks" onclick="openTab(event, 'Administrator')">Administrator</button></th> 
                    </tr> 
                </table> 

                <!-- Tab Karyawan -->
                <div id="Karyawan" class="tabcontent" style="display: none;">
                    <!-- Company Selecting -->
                    <table style="width: 100%; padding: 5px; padding-bottom: 15px;"> 
                        <tr> 
                            <th style="width: 50%; text-align: left;"> 
                                Company                      
                            </th> 
                            <th style="width: 50%; text-align: right;"> 
                                <select> 
                                    <option value="PT. Mandiri Konsultama Perkasa">PT. Mandiri Konsultama Perkasa</option>  
                                </select> 
                            </th> 
                        </tr> 
                    </table> 

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/login') }}"> 
                        {{ csrf_field() }} 
                        <!-- Email Address Karyawan-->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                            <table style="width: 100%; padding: 5px; padding-bottom: 15px;"> 
                                <tr> 
                                    <th style="width: 50%; text-align: left;"> 
                                        <label for="email" class="col-md-4 control-label" style="text-align: left;">E-Mail Address</label>              
                                    </th> 
                                    <th style="width: 50%; text-align: right;"> 
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="width: 100%;" autofocus> 

                                        @if ($errors->has('email')) 
                                        <span class="help-block"> 
                                            <strong>{{ $errors->first('email') }}</strong> 
                                        </span> 
                                        @endif 
                                    </th> 
                                </tr> 
                            </table>

                            <!-- dom code changed by KT @16/08/2018 19.14-->
                            <!-- <label for="email" class="col-md-4 control-label" style="text-align: left;">E-Mail Address</label> 

                            <div class="col-md-6"> 
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus> 

                                @if ($errors->has('email')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('email') }}</strong> 
                                </span> 
                                @endif 
                            </div>  -->
                        </div> 

                        <!-- Password Textbox Karyawan-->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> 
                            <table style="width: 100%; padding: 5px; padding-bottom: 15px;"> 
                                <tr> 
                                    <th style="width: 50%; text-align: left;"> 
                                        <label for="password" class="col-md-4 control-label">Password</label>
                                    </th> 
                                    <th style="width: 50%; text-align: right;"> 
                                        <input id="password" type="password" class="form-control" name="password" style="width: 100%;"> 

                                        @if ($errors->has('password')) 
                                        <span class="help-block"> 
                                            <strong>{{ $errors->first('password') }}</strong> 
                                        </span> 
                                        @endif  
                                    </th> 
                                </tr> 
                            </table>

                            <!-- dom code changed by KT @16/08/2018 19.14 -->
                            <!-- <label for="password" class="col-md-4 control-label">Password</label> 

                            <div class="col-md-6"> 
                                <input id="password" type="password" class="form-control" name="password"> 

                                @if ($errors->has('password')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('password') }}</strong> 
                                </span> 
                                @endif 
                            </div>  -->
                        </div> 

                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4"> 
                                <div class="checkbox"> 
                                    <label> 
                                        <input type="checkbox" name="remember"> Remember Me 
                                    </label> 
                                </div> 
                            </div> 
                        </div> 

                        <!-- Button Login -->
                        <div class="form-group"> 
                            <div class="col-md-8 col-md-offset-4" style="padding-top: 20px;"> 
                                <button type="submit" class="btn btn-primary""> 
                                    Login 
                                </button> 

                                <a class="btn btn-link" href="{{ url('/user/password/reset') }}" style="font-size: 12px;"> 
                                    Forgot Your Password? 
                                </a> 
                            </div> 
                        </div> 
                    </form> 
                </div> 

                <!-- Tab Administrator -->
                <div id="Administrator" class="tabcontent"> 
                    <table style="width: 100%; padding: 5px; padding-bottom: 15px;"> 
                        <tr> 
                            <th style="width: 50%; text-align: left;"> 
                                Company                      
                            </th> 
                            <th style="width: 50%; text-align: right;"> 
                                <select> 
                                    <option value="PT. Mandiri Konsultama Perkasa">PT. Mandiri Konsultama Perkasa</option>  
                                </select> 
                            </th> 
                        </tr> 
                    </table> 

                    <!-- Pembuka Form Email & Password Administrator -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}"> 
                        {{ csrf_field() }} 
                        <!-- Email Address Administrator -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                            <table style="width: 100%; padding: 5px; padding-bottom: 15px;"> 
                                <tr> 
                                    <th style="width: 50%; text-align: left;"> 
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                    </th> 
                                    <th style="width: 50%; text-align: right;"> 
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="width: 100%;"autofocus> 

                                        @if ($errors->has('email')) 
                                        <span class="help-block"> 
                                            <strong>{{ $errors->first('email') }}</strong> 
                                        </span> 
                                        @endif 
                                    </th> 
                                </tr> 
                            </table>

                            <!-- dom code changed by KT @16/08/2018 19.14 -->
                            <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6"> 
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus> 

                                @if ($errors->has('email')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('email') }}</strong> 
                                </span> 
                                @endif 
                            </div>  -->
                        </div> 

                        <!-- Password Administrator -->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> 
                            <table style="width: 100%; padding: 5px; padding-bottom: 15px;"> 
                                <tr> 
                                    <th style="width: 50%; text-align: left;"> 
                                        <label for="password" class="col-md-4 control-label">Password</label>
                                    </th> 
                                    <th style="width: 50%; text-align: right;"> 
                                        <input id="password" type="password" class="form-control" name="password" style="width: 100%;"> 

                                        @if ($errors->has('password')) 
                                        <span class="help-block"> 
                                            <strong>{{ $errors->first('password') }}</strong> 
                                        </span> 
                                        @endif 
                                    </th> 
                                </tr> 
                            </table>

                            <!-- dom code changed by KT @16/08/2018 19.29 -->
                            <!-- <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6"> 
                                <input id="password" type="password" class="form-control" name="password"> 

                                @if ($errors->has('password')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('password') }}</strong> 
                                </span> 
                                @endif 
                            </div> -->
                        </div> 

                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4"> 
                                <div class="checkbox"> 
                                    <label> 
                                        <input type="checkbox" name="remember"> Remember Me 
                                    </label> 
                                </div> 
                            </div> 
                        </div> 

                        <div class="form-group"> 
                            <div class="col-md-8 col-md-offset-4" style="padding-top: 20px;"> 
                                <button type="submit" class="btn btn-primary"> 
                                    Login 
                                </button> 

                                <a class="btn btn-link" href="{{ url('/admin/password/reset') }}" style="font-size: 12px;"> 
                                    Forgot Your Password? 
                                </a>
                                <br>
                                <a class="btn btn-link" href="{{ url('/admin/register') }}" style="font-size: 12px;"> 
                                    register Admin
                                </a>
                                <br>
                                <a class="btn btn-link" href="{{ url('/user/register') }}" style="font-size: 12px;"> 
                                    register User
                                </a>
                            </div> 
                        </div> 
                    </form> 
                </div>
            </div> 
        </div> 
    </div> 
</div> 

<script> 
    function openTab(evt, tabName) { 
        var i, tabcontent, tablinks; 
        tabcontent = document.getElementsByClassName("tabcontent"); 
        for (i = 0; i < tabcontent.length; i++) { 
            tabcontent[i].style.display = "none"; 
        } 
        tablinks = document.getElementsByClassName("tablinks"); 
        for (i = 0; i < tablinks.length; i++) { 
            tablinks[i].className = tablinks[i].className.replace(" active", ""); 
        } 
        document.getElementById(tabName).style.display = "block"; 
        evt.currentTarget.className += " active"; 
    } 

    document.getElementById("defaultOpen").click(); 
</script> 
</body> 
</html>