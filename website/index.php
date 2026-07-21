<?php

require_once __DIR__ . '/import-data.php';

$importedData = loadLeaderboardData();

$leaderboardEntries = $importedData['leaderboard'] ?? [];
foreach ($leaderboardEntries as &$entry) {
    $entry['points'] = (int) ($entry['rescued'] ?? 0);
    $entry['points_redeemed'] = 0;
}
unset($entry);

$totalLeaguePoints = array_sum(array_column($leaderboardEntries, 'points'));
$leaderboardPayload = [
    'season_start_label' => '01.01.2026',
    'available_points' => 5000,
    'available_points_note' => '5000 points have been sponsored by Peng and Bavaria.',
    'total_points' => $totalLeaguePoints,
    'total_redeemed' => 0,
    'data' => $leaderboardEntries,
];

$contactFormUrl = 'https://ucs.pen.gg/nextcloud/apps/forms/s/9fNwRxfTyRyps9NzbC5Xco4w';

// Example data arrays

$shop_items = [
    ["name" => "Fire Extinguisher (marine powder, MED-approved)", "points" => "40-55", "img" => "ChatGPT Image 28. Juli 2025, 11_21_22.png"],
    ["name" => "Distress Signal Kit (SOLAS flares)", "points" => "50-90", "img" => "ChatGPT Image 28. Juli 2025, 11_53_02.png"],
    ["name" => "Emergency Blanket (pack of 10)", "points" => "8-15", "img" => "ChatGPT Image 28. Juli 2025, 12_14_27.png"],
    ["name" => "First Aid Kit (marine hard-case)", "points" => "40-80", "img" => "ChatGPT Image 28. Juli 2025, 11_27_45.png"],
    ["name" => "Helmet (water impact / rescue crew)", "points" => "80-150", "img" => "ChatGPT Image 28. Juli 2025, 11_29_42.png"],
    ["name" => "Lifejacket 150N (inflatable automatic)", "points" => "60-100", "img" => "ChatGPT Image 28. Juli 2025, 11_37_49.png"],
    ["name" => "Lifejacket 275N (SOLAS inflatable automatic)", "points" => "120-180", "img" => "ChatGPT Image 28. Juli 2025, 11_37_49.png"],
    ["name" => "Lifejacket 100N (foam PFD)", "points" => "25-45", "img" => "ChatGPT Image 28. Juli 2025, 11_37_49.png"],
    ["name" => "Hygiene / Sanitary Kit (per person)", "points" => "10-15", "img" => "ChatGPT Image 28. Juli 2025, 11_40_06.png"],
    ["name" => "Water Bottle (reusable 1L, BPA-free)", "points" => "2-5", "img" => "ChatGPT Image 28. Juli 2025, 12_20_53.png"],
    ["name" => "Stethoscope (adult Littmann-type)", "points" => "40-80", "img" => ""],
    ["name" => "Blood Pressure Monitor (automatic upper arm)", "points" => "25-50", "img" => ""],
    ["name" => "Pulse Oximeter (fingertip)", "points" => "15-30", "img" => ""],
    ["name" => "Mobile Ultrasound (handheld)", "points" => "2500-6500", "img" => "ChatGPT Image 28. Juli 2025, 13_20_13.png"],
    ["name" => "Hypothermia Kit", "points" => "15-25", "img" => ""],
    ["name" => "AIS Transponder (Class B)", "points" => "400-700", "img" => "ChatGPT Image 28. Juli 2025, 11_50_43.png"],
    ["name" => "AIS Receiver (receive-only)", "points" => "150-300", "img" => "ChatGPT Image 28. Juli 2025, 11_50_43.png"],
    ["name" => "Handheld VHF Radio (marine, 6W, IPX7)", "points" => "80-250", "img" => "ChatGPT Image 28. Juli 2025, 11_42_18.png"],
    ["name" => "Fixed VHF Radio (25W, DSC)", "points" => "150-350", "img" => "ChatGPT Image 28. Juli 2025, 11_42_18.png"],
    ["name" => "Binoculars (marine 7x50 with compass)", "points" => "90-250", "img" => "ChatGPT Image 28. Juli 2025, 13_05_59.png"],
    ["name" => "Water Purification (portable gravity filter)", "points" => "60-90", "img" => "ChatGPT Image 28. Juli 2025, 13_02_47.png"],
    ["name" => "Water Purification (seawater desalinator)", "points" => "300-1600", "img" => "ChatGPT Image 28. Juli 2025, 13_02_47.png"],
    ["name" => "Emergency Food Ration (2400 kcal)", "points" => "9-20", "img" => "ChatGPT Image 28. Juli 2025, 11_54_49.png"],
    ["name" => "Inflatable Boat Repair Kit", "points" => "15-35", "img" => "ChatGPT Image 28. Juli 2025, 13_08_57.png"],
    ["name" => "Foot Pump (high volume)", "points" => "30-80", "img" => ""],
    ["name" => "Spare Oars / Paddles (set of 2)", "points" => "50-100", "img" => ""],
    ["name" => "Valve Tool & Spare Valves", "points" => "10-25", "img" => "ChatGPT Image 28. Juli 2025, 13_08_57.png"],
    ["name" => "Thermal SAR Drone", "points" => "5300-7000", "img" => ""],
    ["name" => "Night Vision Monocular", "points" => "1000-2500", "img" => ""],
];

function getShopItemIconPath(string $itemName): string
{
    $name = strtolower($itemName);

    if (str_contains($name, 'ultrasound')) {
        return 'assets/icons-new/icons/ultrasound.png';
    }
    if (str_contains($name, 'blood pressure')) {
        return 'assets/icons-new/icons/icon_blutdruck.png';
    }
    if (str_contains($name, 'stethoscope')) {
        return 'assets/icons-new/icons/icon_arzt.png';
    }
    if (str_contains($name, 'oximeter') || str_contains($name, 'first aid')) {
        return 'assets/icons-new/icons/erstehilfe.png';
    }
    if (str_contains($name, 'hypothermia') || str_contains($name, 'blanket')) {
        return 'assets/icons-new/icons/rettungsdecke.png';
    }
    if (str_contains($name, 'drone')) {
        return 'assets/icons-new/icons/icon_drone.png';
    }
    if (str_contains($name, 'distress signal')) {
        return 'assets/icons-new/icons/signal.png';
    }
    if (str_contains($name, 'fire extinguisher')) {
        return 'assets/icons-new/icons/fire-extinguisher.png';
    }
    if (str_contains($name, 'helmet')) {
        return 'assets/icons-new/icons/helm.png';
    }
    if (str_contains($name, 'lifejacket')) {
        return 'assets/icons-new/icons/weste.png';
    }
    if (str_contains($name, 'hygiene') || str_contains($name, 'sanitary')) {
        return 'assets/icons-new/icons/hygiene.png';
    }
    if (str_contains($name, 'ais')) {
        return 'assets/icons-new/icons/ais.png';
    }
    if (str_contains($name, 'vhf') || str_contains($name, 'radio')) {
        return 'assets/icons-new/icons/radio.png';
    }
    if (str_contains($name, 'binocular') || str_contains($name, 'night vision')) {
        return 'assets/icons-new/icons/icon_fernrohr.png';
    }
    if (str_contains($name, 'water purification')) {
        return 'assets/icons-new/icons/watersystem.png';
    }
    if (str_contains($name, 'water')) {
        return 'assets/icons-new/icons/Water.png';
    }
    if (str_contains($name, 'food')) {
        return 'assets/icons-new/icons/food.png';
    }
    if (str_contains($name, 'pump')) {
        return 'assets/icons-new/icons/icon_pumpe.png';
    }
    if (str_contains($name, 'repair') || str_contains($name, 'kleber')) {
        return 'assets/icons-new/icons/icon_Kleber.png';
    }
    if (str_contains($name, 'valve') || str_contains($name, 'tool') || str_contains($name, 'werkzeug')) {
        return 'assets/icons-new/icons/icon_werkzeug.png';
    }
    if (str_contains($name, 'oars') || str_contains($name, 'paddles') || str_contains($name, 'boat')) {
        return 'assets/icons-new/icons/Boat.png';
    }

    return 'assets/icons-new/icons/erstehilfe.png';
}
   
    
    
    
    
    


            
            
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Open Borders League</title>
                <link rel="icon" type="image/png" href="./assets/icons-new/icons/weste.png">
                <!-- Styles are loaded via main.js (Vite bundle) -->
            </head>
            <body>

                <!-- About / Description (with floating yellow box for title+subtitle) -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-left" style="position:relative;">
                            <span class="floating-title floating-title-main">Open Borders League<br><span class="floating-subtitle">A counter-program to remigration fantasies</span></span>
                            <div style="margin-top:3.5em;">
                                <p>In a political climate increasingly dominated by far-right calls for “remigration” and militarized borders, this project offers a bold and ironic counter-narrative: the Open Borders League — a public, gamified rewards system for organizations that help people reach safety and claim their right to asylum.</p>
                                <p>Inspired by Ukraine’s <a href="https://brave1.gov.ua/en/" target="_blank" rel="noopener noreferrer" class="poster-link">BRAVE1</a> initiative — where drone operators earn points redeemable for gear — we flip the script: not points for killing, but for rescuing. Every person supported in reaching safety earns points. These points are then redeemable for concrete tools like drones, radios, life jackets, or software — resources used to save even more lives.</p>
                                <p>This is not charity. It’s a pragmatic and radically transparent mechanism to reward and empower those building an open society. If they can gamify deportation, we can gamify rescue.</p>
                                <div style="margin-top:1.5rem; aspect-ratio:16 / 9; width:100%;">
                                    <iframe
                                        width="100%"
                                        height="100%"
                                        src="https://www.youtube.com/embed/Y_rN6JKyQ64"
                                        title="Open Borders League video"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                        style="border:0; border-radius:8px;"
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Leaderboard Table -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-right" style="position:relative;">
                            <span class="floating-title">Leaderboard</span>
                            <p class="has-text-centered has-text-grey season-summary" style="margin-top:2.5em;">
                                <span class="summary-label">Counted rescues:</span> cumulative totals since <strong>01.01.2026</strong>
                                <br>This leaderboard shows the cumulative total of every recorded rescue since the start of 2026.
                            </p>

                            <div class="points-availability-bar" aria-label="Sponsored points available">
                                <div class="points-availability-header">
                                    <span class="points-availability-label">Points available (*)</span>
                                    <span class="points-availability-total mono">5000</span>
                                </div>
                                <div class="status-bar status-bar-sponsored" aria-hidden="true">
                                    <span class="status-bar-fill" style="width: 100%;"></span>
                                </div>
                                <p class="points-availability-note">(*) <?php echo htmlspecialchars($leaderboardPayload['available_points_note']); ?></p>
                            </div>

                            <script type="application/json" id="leaderboardDataJson">
                            <?php echo json_encode($leaderboardPayload, JSON_PRETTY_PRINT); ?>
                            </script>
                            
                            <table class="table is-fullwidth game-leaderboard">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>NGO</th>
                                        <th class="has-text-right">Points</th>
                                        <th class="has-text-right">Points Redeemed</th>
                                        <th>Rescue Progress</th>
                                    </tr>
                                </thead>
                                <tbody id="leaderboardBody">
                                    <tr><td colspan="5" class="has-text-centered has-text-grey" style="padding:2em 0;">Loading...</td></tr>
                                </tbody>
                                <tfoot>
                                    <tr class="totals-row">
                                        <td></td>
                                        <td>Total League Points</td>
                                        <td class="mono has-text-right score-counter" id="totalPointsCell" data-score="0">0000</td>
                                        <td class="mono has-text-right score-counter" id="totalRedeemedCell" data-score="0">0000</td>
                                        <td>
                                            <div class="status-bar status-bar-total" aria-label="Total points">
                                                <span class="status-bar-fill" style="width: 100%;"></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="leaderboard-community-note">We do not only support sea rescue organizations. If you know other organizations that have helped people on the move and should appear on the scoreboard, please write to us.</p>
                        </div>
                    </div>
                </section>

                <!-- Shop Section -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-left" style="position:relative;">
                            <span class="floating-title">Rescue Market</span>
                            <div class="inventory-header" style="margin-top:2.5em;">
                                <span class="inventory-badge">Inventory</span>
                                <span class="inventory-badge inventory-badge-ghost">Unlocked Gear</span>
                            </div>
                            <div class="columns is-multiline inventory-grid" style="margin-top:1rem;">
                                <?php foreach ($shop_items as $item): ?>
                                <?php
                                    $iconPath = getShopItemIconPath($item['name']);
                                ?>
                                <div class="column is-full-mobile is-half-tablet is-one-quarter-desktop">
                                    <div class="box has-text-centered shop-item-card">
                                        <span class="inventory-item-class">Rescue Gear</span>
                                        <img src="./<?php echo htmlspecialchars($iconPath); ?>" alt="Icon for <?php echo htmlspecialchars($item['name']); ?>" class="shop-img shop-img-icon" />
                                        <h3 class="title is-5 shop-item-title"><?php echo htmlspecialchars($item['name']); ?></h3>
                                        <a class="shop-item-points" href="<?php echo htmlspecialchars($contactFormUrl); ?>" target="_blank" rel="noopener noreferrer">Redeem for <?php echo $item['points']; ?> points</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div class="column is-full-mobile is-half-tablet is-one-quarter-desktop">
                                    <div class="box has-text-centered shop-item-card shop-item-card-help">
                                        <span class="inventory-item-class">Support</span>
                                        <div class="shop-help-icon" aria-hidden="true"></div>
                                        <h3 class="title is-5 shop-item-title">Item missing?</h3>
                                        <p class="shop-item-points">Contact the game devs and tell us what should be added.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- FAQ Section -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-right" style="position:relative;">
                            <span class="floating-title">FAQ</span>
                            <div class="content" style="margin-top:2.5em;">
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>What counts as a 'rescued person'?</strong></div>
                                    <div class="faq-answer">
                                        <p>Anyone who was in distress at sea - in a sinking boat, a rubber dinghy with a dead engine, a container ship hull, or just floating on debris - and was brought aboard a rescue vessel safe enough to make landfall.</p>
                                        <p>We count them. No paperwork tricks. If they were in danger and now they're not, that's a rescue. Each person = 1 point. No caps. No quotas.</p>
                                        <p>The EU would call them "irregular migrants." We call them people who didn't drown today.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>Isn't this just gamifying human suffering?</strong></div>
                                    <div class="faq-answer">
                                        <p>We didn't start this game.</p>
                                        <p>The far right gamified deportation first - points for "remigration," leaderboards for how fast you can push people back out, rewards for making the Mediterranean a graveyard.</p>
                                        <p>All we did was build a faster, better game on the same map. Theirs rewards cruelty. Ours rewards keeping people alive.</p>
                                        <p>If you find the leaderboard uncomfortable, aim that discomfort at the system that made it necessary. The game exists because the boats exist. The boats exist because the borders exist. We're just pointing the scoreboard in a different direction.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>How do I donate?</strong></div>
                                    <div class="faq-answer">
                                        <p>You can sponsor gear directly to an NGO partner. Every donation buys real equipment - not overhead, not admin. A fire extinguisher keeps a vessel safe. A lifejacket keeps a person afloat. A drone finds boats that patrols want to miss.</p>
                                        <p>We don't run a fund ourselves. We point you to the people who do the work, and we make sure you can see exactly where your money went.</p>
                                        <p>Transparency isn't a marketing gimmick here. It's the whole point.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>What if NGOs disagree with the system?</strong></div>
                                    <div class="faq-answer">
                                        <p>Then they've already won.</p>
                                        <p>The league exists to <em>support</em> SAR NGOs - not to rank them, not to judge them, not to create competition where there should be solidarity. If a group doesn't want to be on the leaderboard, they don't sign up. If they prefer to remain anonymous, fine. If they think the whole concept is a dumb gimmick from some art collective - also fine.</p>
                                        <p>But we've talked to enough crew members. Most of them are running on fumes, donated gear, and stubborn hope. If we can get them better radios, more lifejackets, and a thermal drone that lets them scan 10 nautical miles in 15 minutes instead of 3 hours - they'll take it. Even if the leaderboard makes them roll their eyes.</p>
                                        <p>Action first. Optics second.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>Doesn't this make it easier for smugglers?</strong></div>
                                    <div class="faq-answer">
                                        <p>No. Smugglers exist <em>because</em> of borders.</p>
                                        <p>Take away the walls and the checkpoints and the visa regimes, and the smuggling business model collapses overnight. You can't charge someone EUR 5,000 for a seat in a coffin boat if they can walk across the border freely. The Mediterranean death toll isn't caused by rescue ships - it's caused by a system that has criminalized movement and outsourced border control to the sea.</p>
                                        <p>The question isn't whether rescue encourages migration. The question is whether you'd rather people live or die. If your policy requires drowning to be effective, it's not a policy - it's a cull.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>What's the long-term goal? To keep running this forever?</strong></div>
                                    <div class="faq-answer">
                                        <p>No. The goal is to make this irrelevant.</p>
                                        <p>An Open Borders League only makes sense in a world where people need rescuing at sea because safe routes don't exist. The real win is a Europe that:</p>
                                        <ul>
                                            <li>Gives anyone fleeing war, poverty, or climate collapse a legal visa, not a razor wire fence</li>
                                            <li>Has rescue coordination that actually coordinates instead of letting people die in a designated "search and rescue zone" while patrol boats watch from outside it</li>
                                            <li>Stops funding border militarization and starts funding the things that actually save lives</li>
                                        </ul>
                                        <p>When that happens, the leaderboard goes dark. Happy ending.</p>
                                        <p>Until then, we count.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>Isn't 'gamifying rescue' cynical?</strong></div>
                                    <div class="faq-answer">
                                        <p>Let's be honest with each other.</p>
                                        <p>What's more cynical: a website that turns rescue into a video game scoreboard, or a European Union that pours billions into border fences, pushback patrols, and "migration management" while people drown 50 kilometers from the nearest port?</p>
                                        <p>We're not the cynics here. We're just building in broad daylight what the system already runs in back rooms. Points for deportation. Bonus for deterrence. "Irregular migration reduction targets" - that's a fucking leaderboard.</p>
                                        <p>At least ours gives out lifejackets.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>Can you really 'open borders'? Wouldn't that be chaos?</strong></div>
                                    <div class="faq-answer">
                                        <p>"Open borders" doesn't mean no rules. It means no deadly rules.</p>
                                        <p>It means a visa you can apply for instead of a smuggler you have to pay. It means a rescue ship instead of a coast guard that tows you back to Libya. It means the right to asylum actually functions instead of being a lottery you have to survive first.</p>
                                        <p>Every country that has tried to fully shut its borders has failed. Every country that has tried humane migration management has found it works better. The numbers are not in dispute. The chaos argument is a scarecrow. The real chaos is what's already happening in the Mediterranean, and it's entirely manufactured.</p>
                                    </div>
                                </div>
                                <div class="faq-item box">
                                    <div class="faq-question"><strong>What does the EU say about you?</strong></div>
                                    <div class="faq-answer">
                                        <p>At this point? Probably nothing good. But that's fine.</p>
                                        <p>The EU has spent 20 years building a border regime that has made the Mediterranean the deadliest migration route on Earth. Tens of thousands dead. Zero accountability. They can call us naive, provocative, or cynical. We'll take it.</p>
                                        <p>But next time a politician stands up and says "we need to stop the boats," ask them: stop them from crossing, or stop them from sinking?</p>
                                        <p>Because you can only do one. If your policy sounds like the second one - you're not stopping anything. You're just counting bodies.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Social Media Links & Footer in last box -->
                <section class="section">
                    <div class="container has-text-centered">
                        <div class="content-block shift-left footer-partners-block">
                            <h2 class="title is-5">Follow Us</h2>
                            <div class="footer-social-links">
                                <a href="https://xcancel.com/peng" target="_blank" rel="noopener noreferrer" class="button is-link is-light">xcancel</a>
                                <a href="https://www.instagram.com/pengcollective" target="_blank" rel="noopener noreferrer" class="button is-link is-light">Instagram</a>
                                <a href="http://tldr.nettime.org/@peng" target="_blank" rel="noopener noreferrer" class="button is-link is-light">Mastodon</a>
                                <a href="https://pen.gg" target="_blank" rel="noopener noreferrer" class="button is-link is-light">Website</a>
                            </div>

                            <div class="cooperation-partners" aria-label="Cooperation partners">
                                <p class="dream-illegal-note">Part of <a href="http://www.dreamillegal.org/" target="_blank" rel="noopener noreferrer">Dream Illegal</a></p>
                                <div class="partners-grid">
                                    <a class="partner-logo-link" href="https://www.stmwk.bayern.de/" target="_blank" rel="noopener noreferrer" aria-label="Bayerisches Staatsministerium fur Wissenschaft und Kunst">
                                        <img class="partner-logo partner-logo-stmwk" src="./assets/partners/stmwk-logo@2x.png" alt="Bayerisches Staatsministerium fur Wissenschaft und Kunst" loading="lazy" />
                                    </a>
                                    <a class="partner-logo-link" href="https://www.bbk-bayern.de/programme/verbindungslinien" target="_blank" rel="noopener noreferrer" aria-label="BBK Verbindungslinien">
                                        <img class="partner-logo partner-logo-bbk" src="./assets/partners/bbk-verbindungslinien@2x.jpg" alt="BBK Verbindungslinien" loading="lazy" />
                                    </a>
                                </div>
                            </div>

                            <p class="footer-credit">&copy; 2026 Open Borders League. Created by <a href="https://pen.gg" target="_blank" rel="noopener noreferrer">Peng Collective</a>.</p>
                        </div>
                    </div>
                </section>

                <!-- Remove separate footer -->
                <button class="floating-donate-btn" onclick="window.open('https://pen.gg/support/', '_blank')">Donate Points</button>
                <button class="floating-contact-btn" onclick="window.open('https://ucs.pen.gg/nextcloud/apps/forms/s/9fNwRxfTyRyps9NzbC5Xco4w', '_blank')">Contact</button>
                <script type="module" src="/main.js"></script>
            </body>
            </html>
