document.addEventListener('DOMContentLoaded', () => {
    const collegeSelect = document.getElementById('college');
    const programSelect = document.getElementById('program');

    collegeSelect.addEventListener('change', async () => {
        const collegeId = collegeSelect.value;

        try {
            const response = await fetch('fetch_programs.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'collegeId=' + encodeURIComponent(collegeId)
            });

            if (response.ok) {
                const programs = await response.text();
                programSelect.innerHTML = programs;
                programSelect.disabled = false;
            } else {
                console.error('Error: Unable to fetch programs.');
            }
        } catch (error) {
            console.error('Network error:', error);
        }
    });
});
