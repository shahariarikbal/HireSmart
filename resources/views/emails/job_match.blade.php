<!DOCTYPE html>
<html>
<head>
    <title>Job Match</title>
</head>
<body>
    <h2>Hello {{ $candidate->name }},</h2>

    <p>Great news! We've found a job that matches your preferences.</p>

    <p><strong>Job Title:</strong> {{ $job->title }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Salary:</strong> {{ $job->salary_min }} - {{ $job->salary_max }}</p>

    <p>Visit our platform to learn more and apply.</p>

    <p>Best regards,<br>Your Job Portal Team</p>
</body>
</html>
