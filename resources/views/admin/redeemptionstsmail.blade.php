@include('admin.mailheader')

                 <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                  <td style="padding-bottom: 15px;">
                    <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px;">Dear {{ $maildata['first_name'] . $maildata['last_name'] }},</p>
                    <p style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px; margin-top: 10px;">Congratulations! Your redemption request for Presto Plast India Rewards App has been approved.
                        </p>
                  </td>
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
                            <strong>Ref No: </strong>
                          </td>   
                            <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right"> {{$maildata['referance_code']}}
                            </td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                            <strong>Coupon No:</strong>
                          </td>   
                            <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['coupon_id']}}</td>
                        </tr>
                        
                        <tr>
                          <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                            <strong>Amount :</strong>
                          </td>   
                            <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['amount']}}</td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                            <strong>Status :</strong>
                          </td>   
                            <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{$maildata['status']}}</td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" class="article">
                            <strong>	Date of Update :</strong>
                          </td>   
                            <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;" align="right">{{date('d-m-Y H:i:s', strtotime($maildata['currentDate']))}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
              
                
                 <tr>
                    <td height="20"></td>
                </tr>
                
                @include('admin.mailfooter')