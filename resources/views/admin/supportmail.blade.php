@include('admin.mailheader')

<tr>
    <td height="30"></td>
</tr>
<tr>
    <td tyle="padding-bottom: 15px; border-top: 1px solid #e4e4e4;">
        <p
            style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px;">
            Dear {{ $maildata['user_name'] }},</p>
        <p
            style="font-family: Helvetica, sans-serif; font-size: 17px; font-weight: normal; margin: 0; margin-bottom: 16px; margin-top: 10px;">
            Thank you for reaching out to us. We have received your support request {{$maildata['token_no']}} and will address it promptly. You can expect a response from us within 24 hours. We appreciate your patience and understanding.
        </p>
    </td>
</tr>
{{-- <tr>
    <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
            <tbody>
                <tr>
                    <td height="10" colspan="4"></td>
                </tr>
                <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        class="article">
                        <strong>Ref No: </strong>
                    </td>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        align="right"> {{ $maildata['ref_no'] }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        class="article">
                        <strong>Bank RRN:</strong>
                    </td>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        align="right">{{ $maildata['bank_rrn'] }}</td>
                </tr>

                <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        class="article">
                        <strong>Amount :</strong>
                    </td>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        align="right">{{ $maildata['amount'] }}</td>
                </tr>
                <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        class="article">
                        <strong>Status :</strong>
                    </td>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        align="right">{{ $maildata['status'] }}</td>
                </tr>
                <tr>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919; line-height: 23px; vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        class="article">
                        <strong>Date</strong>
                    </td>
                    <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #1a1919;  line-height: 23px;  vertical-align: top; padding:10px; border-bottom: 1px solid #e4e4e4;"
                        align="right">{{ $maildata['date'] }}</td>
                </tr>
            </tbody>
        </table>
    </td>
</tr> --}}
<tr>
</tr>

<tr>
    <td style="padding-top: 10px" height="20">Thank you!</td>
</tr>

<tr>
    <td style="padding-top: 10px" height="20">Best Regards</td>
</tr>


<tr>
    <td height="40"></td>
</tr>

@include('admin.mailfooter')
