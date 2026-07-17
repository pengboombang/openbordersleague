import './assets/style.css';
import 'bulma/css/bulma.min.css';

// Parse monthly data and set up month switching
document.addEventListener('DOMContentLoaded', function () {
    const dataScript = document.getElementById('monthlyDataJson');
    const monthlyData = dataScript ? JSON.parse(dataScript.textContent) : {};
    const initialActiveTab = document.querySelector('#monthTabs li.is-active');
    let currentMonth = initialActiveTab
        ? initialActiveTab.dataset.month
        : (Object.keys(monthlyData).find(month => !monthlyData[month]?.locked) || null);

    // Function to render the leaderboard for a specific month
    window.selectMonth = function(month) {
        if (!monthlyData[month]) return;
        if (monthlyData[month].locked) return;
        
        currentMonth = month;
        const monthInfo = monthlyData[month];
        
        // Update month label
        document.getElementById('currentMonthLabel').textContent = `Data for ${monthInfo.label}`;
        
        // Update tab active state
        document.querySelectorAll('#monthTabs li').forEach(li => {
            li.classList.remove('is-active');
            if (li.dataset.month === month) {
                li.classList.add('is-active');
            }
        });
        
        // Render table rows
        const tbody = document.getElementById('leaderboardBody');
        tbody.innerHTML = '';
        
        if (monthInfo.data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="has-text-centered has-text-grey" style="padding:2em 0;">No rescue data recorded for this month yet.</td></tr>';
        } else {
            const maxScore = Math.max(...monthInfo.data.map(e => e.rescued));
            
            monthInfo.data.forEach(entry => {
                const barPercent = maxScore > 0 ? Math.round((entry.rescued / maxScore) * 100) : 0;
                const pointsPadded = String(entry.rescued).padStart(4, '0');
                const ngoLink = entry.website 
                    ? `<a class="ngo-link" href="${entry.website}" target="_blank" rel="noopener noreferrer">${entry.ngo}</a>`
                    : `<span class="ngo-name">${entry.ngo}</span>`;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${entry.rank}</td>
                    <td>${ngoLink}</td>
                    <td class="mono has-text-right score-counter" data-score="${entry.rescued}">${pointsPadded}</td>
                    <td>
                        <div class="status-bar" aria-label="${entry.ngo} progress">
                            <span class="status-bar-fill" style="width: ${barPercent}%;"></span>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }
        
        // Update total points
        const totalCell = document.getElementById('totalPointsCell');
        const totalPadded = String(monthInfo.total).padStart(4, '0');
        totalCell.dataset.score = monthInfo.total;
        totalCell.textContent = totalPadded;
        
        // Trigger animations for the new scores
        animateScores();
    };
    
    // Initialize with default month
    if (currentMonth) {
        window.selectMonth(currentMonth);
    }

    // FAQ accordion: only one open at a time for cleaner scanning.
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (!question) return;

        question.addEventListener('click', () => {
            const willOpen = !item.classList.contains('is-open');

            faqItems.forEach(other => {
                other.classList.remove('is-open');
            });

            if (willOpen) {
                item.classList.add('is-open');
            }
        });
    });
});

// Slot-machine score animation
function animateScores() {
    const counters = document.querySelectorAll('.score-counter[data-score]');

    counters.forEach(function (el) {
        const target = parseInt(el.dataset.score, 10);
        if (isNaN(target) || target === 0) return;

        const duration = 2200;
        const padWidth = 4;
        let startTime = null;

        // Reset to zeros before animating
        el.textContent = '0000';

        function frame(timestamp) {
            if (!startTime) startTime = timestamp;
            const elapsed = timestamp - startTime;
            const progress = Math.min(elapsed / duration, 1);

            let display;
            if (progress < 0.65) {
                // Slot-machine spinning phase: rapid random numbers
                const rand = Math.floor(Math.random() * Math.max(target * 2, 1000));
                display = String(rand).padStart(padWidth, '0');
            } else {
                // Deceleration phase: ease-out count-up to target
                const p = (progress - 0.65) / 0.35;
                const eased = 1 - Math.pow(1 - p, 3);
                display = String(Math.round(eased * target)).padStart(padWidth, '0');
            }

            el.textContent = display;

            if (progress < 1) {
                requestAnimationFrame(frame);
            } else {
                el.textContent = String(target).padStart(padWidth, '0');
            }
        }

        requestAnimationFrame(frame);
    });
}
