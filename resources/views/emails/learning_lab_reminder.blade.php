<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Learning Lab Reminder</title>
</head>
<body style="margin:0; padding:0; background-color:#eef2f5; font-family: Arial, sans-serif; line-height:1.6;">

<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center" style="padding:16px">

            <!-- MAIN CARD -->
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="max-width:100%; background:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 10px 10px rgba(0,0,0,0.08);">

                <!-- HEADER -->
                <tr>
                    <td style="background:#14532d; padding:26px 32px;">
                        <h2 style="margin:0; font-size:22px; color:#ffffff; font-weight:600;">
                            📢 Learning Lab Registration Confirmation & Reminder
                        </h2>
                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:32px; color:#111827; font-size:15px;">

                        <strong style="margin-top:0;">
                            Dear {{ $registration->full_name }},
                        </strong>

                        <p>
                            Thank you for registering to participate in the Learning Lab. We are pleased to confirm your enrollment in the following session:
                        </p>

                        <!-- SESSION DETAILS -->
                        <table width="100%" cellpadding="10" cellspacing="0"
                               style="margin:22px 0; background:#f8fafc; border-radius:10px; border:1px solid #e5e7eb;">
                            <tr>
                                <td width="140" style="font-weight:600;">Topic</td>
                                <td>{{ $lab->topic }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Date</td>
                                <td>{{ \Carbon\Carbon::parse($lab->date)->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Time</td>
                                <td>{{ $lab->time }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Format</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $lab->format)) }}</td>
                            </tr>
                        </table>

                        @if($lab->link)
                        <p style="margin:22px 0;">
                            <strong>Meeting Link:</strong><br>
                            <span>Please join the session using the following Zoom link:</span><br>
                            <a href="{{ $lab->link }}"
                               style="color:#2563eb; word-break:break-word; display:inline-block; margin-top:6px;">
                                {{ $lab->link }}
                            </a>
                        </p>
                        @endif

                        <p>
                            We kindly encourage you to join the meeting a few minutes early to ensure a smooth start.
                            We look forward to your active participation and valuable engagement in this Learning Lab session.
                        </p>

                        <p style="margin-top:28px;">
                            Warm regards,<br>
                            <strong>Learning Lab Team</strong><br>
                            <strong>Facilitated by NGO Forum On Cambodia (NGOF)</strong>
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background:#f3f4f6; padding:14px 24px; text-align:center; font-size:12px; color:#6b7280;">
                        © {{ date('Y') }} NGO Forum On Cambodia. All rights reserved.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
