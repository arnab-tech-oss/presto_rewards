<tr>
  <td>
      <p>Thank You!</p>
      <p>Best Regards,</p>
      <p> {!!optional(DB::table('setting_apps')->first())->title!!} </p>
  </td>
</tr>


{{-- <tr>
    <td style="text-align: center;">
        <a href="#" style="text-align: center;
                display: inline-block;
                background: #1877f2;
                padding: 10px 16px;
                color: #fff;
                border-radius: 5px;
                text-decoration: none;
                margin-top: 25px;">Get More Details</a> 
    </td>
</tr> --}}

<tr>
    <td height="40"></td>
</tr>


<tr>
    <td style="padding-top: 15px; border-top: 1px solid #e4e4e4; text-align: center;">
    <span style="padding-right:12px;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif">Contact Us:</span>
    <span style="color:#141823;font-size:14px;font-weight:normal;line-height:24px;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif"><a style="color:#1b74e4;text-decoration:none" href=""> support@prestorewardsapp.com</a></span>
    </td>
</tr>



<!-- END MAIN CONTENT AREA -->
</tbody></table>

<!-- START FOOTER -->
<div class="footer" style="clear: both; padding-top: 24px; text-align: center; width: 100%;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
<tbody>

<tr>
  <td class="content-block" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; padding-bottom: 10px; font-size: 16px; text-align: center;" valign="top" align="center">
    <span class="apple-link" style="color: #9a9ea6; font-size: 15px; text-align: center;"> {!!optional(DB::table('setting_apps')->first())->footer_left!!} </span>
    
  </td>

</tr>
<tr>
  <td class="content-block powered-by" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center; margin-top: 20px;" valign="top" align="center">
    
    @foreach(footer_content() as $data)
    <a href={{ strip_tags($data->description) }} class="text-small" target="_blank" style="color: #9a9ea6; font-size: 15px; text-align: center; text-decoration: none;">{{$data->tittle}}</a> |
    @endforeach
      
  </td>
</tr>


</tbody>
</table>
</div>

<!-- END FOOTER -->

<!-- END CENTERED WHITE CONTAINER --></div>
</td>
<td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
</tr>
</tbody></table>


</body></html>