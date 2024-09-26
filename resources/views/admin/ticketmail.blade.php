@include('admin.mailheader')

               <tr>
                  <td height="30"></td>
              </tr>
              <tr>
                  <td tyle="padding-bottom: 15px; border-top: 1px solid #e4e4e4;">
                       <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px;"></p><p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px;">Dear {{$maildata['customer_id']}},</p>
                      <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px; margin-top: 10px;">Thank you for reaching out to PrestoRewards support. Your request has been received, and our team will attend to it promptly. For updates, please check your PrestoRewards app.

                        </p>
                  </td>
              </tr>
              <tr>
                  <td height="20"></td>
              </tr>
              <tr>
                  
            <td>
              {{-- <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                <tbody>
                  <tr>
                    <td height="10" colspan="4"></td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Subject: </strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">Support Request Received Ref No: {{$maildata['ticket_no']}}
                      </td>
                  </tr>
                  <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                      <strong>Content:</strong>
                    </td>   
                      <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">Dear User:{{$maildata['customer_id']}}</td>
                  </tr>
                  
                </tbody>
              </table> --}}
            </td>
          </tr>
              
               <tr>
                  <td height="20"></td>
              </tr>
              
                <tr>
                  <td>
                      {{-- <p>Please use the provided credentials to log in to your account via our website https://pos.wbicabooks.com/. Once logged in, you'll have access to a range of features tailored to your role.
                        .</p> --}}
                      {{-- <p>Happy redeeming!</p> --}}
                  </td>
              </tr>
           
              
              @include('admin.mailfooter')