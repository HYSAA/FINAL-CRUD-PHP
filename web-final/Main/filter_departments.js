document.addEventListener('DOMContentLoaded', () => {
    const collegeSelect = document.getElementById('college');
    const departmentSelect = document.getElementById('department');
    const progId = document.getElementById('progId');

    collegeSelect.addEventListener('change', async () => {
        const collegeId = collegeSelect.value;

        try {
            const response = await fetch('fetch_departments.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'collegeId=' + encodeURIComponent(collegeId)
            });

            if (response.ok) {
                const departments = await response.text();
                departmentSelect.innerHTML = departments;
                departmentSelect.disabled = false;

           
                progId.value = collegeId + "000";
            } else {
                console.error('There was a problem with the request.');
            }
        } catch (error) {
            console.error('There was a network problem.', error);
        }
    });
});
