@include('admin.mailheader')

               <tr>
                  <td height="30"></td>
              </tr>
              <tr>
                  <td tyle="padding-bottom: 15px; border-top: 1px solid #e4e4e4;">
                    {{-- <p>Subject: Welcome to I&CA Book Store - Your Account Details – {{$maildata['name']}}</p> --}}
                    <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px;">Dear {{$maildata['name']}},</p>
                      <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px; margin-top: 10px;">Congratulations! You Have Successfully Registered – Welcome to Presto Plast Reward.
                        </p>
                  </td>
              </tr>
              <tr>
                  <td height="20"></td>
              </tr>
              <tr>
                  
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                <tbody>
                  <tr>
                    <td height="10" colspan="4"></td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Ref No:</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['referance_code']}}</td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Mobile No:</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['phone']}}</td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Password:</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['password']}}</td>
                  </tr>
                    <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Passcode :</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['passcode']}}</td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
              
               <tr>
                  <td height="20"></td>
              </tr>
              
                <tr>
                  <td>
                      {{-- <p>Please use the provided credentials to log in to your account via our website https://pos.wbicabooks.com/. Once logged in, you'll have access to a range of features tailored to your role.
                        .</p> --}}
                      <p>Get started by downloading our app: {{optional(DB::table('setting_apps')->first())->playstore_url}}</p>
                  </td>
              </tr>
           
              
              @include('admin.mailfooter')