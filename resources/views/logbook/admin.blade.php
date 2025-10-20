<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Logbook Entries</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; max-width: 800px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .feedback { margin-top: 10px; padding: 10px; border-radius: 4px; display: none; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <h1>Admin Dashboard: Edit Activity</h1>
    <p>Use this form to edit the details of a specific job activity. The changes will be submitted as a change request.</p>

    <form id="editActivityForm">
        <input type="hidden" id="activityId" name="activity_id" value="123">

        <div class="form-group">
            <label for="activityName">Activity Name</label>
            <input type="text" id="activityName" name="name" value="Initial Design Phase" required>
        </div>

        <div class="form-group">
            <label for="jobWeight">Job Weight (%)</label>
            <input type="number" id="jobWeight" name="weight" value="15" min="0" max="100" required>
        </div>

        <div class="form-group">
            <label for="activityDate">Activity Date</label>
            <input type="date" id="activityDate" name="activity_date" value="2025-10-20" required>
        </div>

        <button type="submit">Submit Change Request</button>
    </form>

    <div id="feedbackMessage" class="feedback"></div>

    <script>
        document.getElementById('editActivityForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const form = event.target;
            const activityId = document.getElementById('activityId').value;
            const feedbackEl = document.getElementById('feedbackMessage');

            // Collect form data into an object
            const data = {
                name: form.elements.activityName.value,
                weight: parseInt(form.elements.jobWeight.value, 10),
                activity_date: form.elements.activityDate.value
            };

            // Display feedback and handle API call
            feedbackEl.style.display = 'none';
            feedbackEl.className = 'feedback'; // Reset classes

            fetch(`/api/activities/${activityId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // Include CSRF token for web routes if not an API route
                    // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(result => {
                console.log('Success:', result);
                feedbackEl.textContent = 'Successfully submitted change request!';
                feedbackEl.classList.add('success');
                feedbackEl.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                feedbackEl.textContent = 'Failed to submit change request. See console for details.';
                feedbackEl.classList.add('error');
                feedbackEl.style.display = 'block';
            });
        });
    </script>

</body>
</html>
