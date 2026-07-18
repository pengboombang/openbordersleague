import './assets/style.css';
import 'bulma/css/bulma.min.css';

// Parse leaderboard data and render the cumulative table.
document.addEventListener('DOMContentLoaded', function () {
    const dataScript = document.getElementById('leaderboardDataJson');
    const leaderboard = dataScript ? JSON.parse(dataScript.textContent) : null;

    if (leaderboard) {
        renderLeaderboard(leaderboard);
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

function renderLeaderboard(leaderboard) {
    const tbody = document.getElementById('leaderboardBody');
    if (!tbody) return;

    tbody.innerHTML = '';

    if (!Array.isArray(leaderboard.data) || leaderboard.data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="has-text-centered has-text-grey" style="padding:2em 0;">No rescue data recorded since 01.01.2026 yet.</td></tr>';
        return;
    }

    const maxScore = Math.max(...leaderboard.data.map(entry => entry.points ?? entry.rescued ?? 0));

    leaderboard.data.forEach(entry => {
        const points = entry.points ?? entry.rescued ?? 0;
        const pointsRedeemed = entry.points_redeemed ?? 0;
        const barPercent = maxScore > 0 ? Math.round((points / maxScore) * 100) : 0;
        const pointsPadded = String(points).padStart(4, '0');
        const redeemedPadded = String(pointsRedeemed).padStart(4, '0');
        const ngoLink = entry.website
            ? `<a class="ngo-link" href="${entry.website}" target="_blank" rel="noopener noreferrer">${entry.ngo}</a>`
            : `<span class="ngo-name">${entry.ngo}</span>`;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${entry.rank}</td>
            <td>${ngoLink}</td>
            <td class="mono has-text-right score-counter" data-score="${points}">${pointsPadded}</td>
            <td class="mono has-text-right score-counter" data-score="${pointsRedeemed}">${redeemedPadded}</td>
            <td>
                <div class="status-bar" aria-label="${entry.ngo} progress">
                    <span class="status-bar-fill" style="width: ${barPercent}%;"></span>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });

    const totalCell = document.getElementById('totalPointsCell');
    if (totalCell) {
        const totalPoints = leaderboard.total_points ?? 0;
        totalCell.dataset.score = totalPoints;
        totalCell.textContent = String(totalPoints).padStart(4, '0');
    }

    const totalRedeemedCell = document.getElementById('totalRedeemedCell');
    if (totalRedeemedCell) {
        const totalRedeemed = leaderboard.total_redeemed ?? 0;
        totalRedeemedCell.dataset.score = totalRedeemed;
        totalRedeemedCell.textContent = String(totalRedeemed).padStart(4, '0');
    }

    animateScores();
}

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
