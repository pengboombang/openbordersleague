<?php




// Example data arrays

$shop_items = [
    ["name" => "Fire Extinguisher", "points" => 100, "img" => "ChatGPT Image 28. Juli 2025, 11_21_22.png"],
    ["name" => "First Aid Kit", "points" => 80, "img" => "ChatGPT Image 28. Juli 2025, 11_27_45.png"],
    
    //hier dann einfach die zeilen kopieren und einfügen
   
   ["name" => "Mobile Ultrasound", "points" => 420, "img" => "ChatGPT Image 28. Juli 2025, 13_20_13.png"],
    
   
   ["name" => "Spare Boat Parts", "points" => 1000, "img" => "ChatGPT Image 28. Juli 2025, 13_08_57.png"],
    
  ["name" => "Binoculars", "points" => 180, "img" => "ChatGPT Image 28. Juli 2025, 13_05_59.png"],
    
   ["name" => "Water Purification System", "points" => 400, "img" => "ChatGPT Image 28. Juli 2025, 13_02_47.png"],
     
   ["name" => "Water Bottles", "points" => 50, "img" => "ChatGPT Image 28. Juli 2025, 12_20_53.png"],
     
   ["name" => "Emergency Blanket", "points" => 40, "img" => "ChatGPT Image 28. Juli 2025, 12_14_27.png"],
      
   ["name" => "Food Supplies", "points" => 200, "img" => "ChatGPT Image 28. Juli 2025, 11_54_49.png"],
     
   ["name" => "Distress Signals", "points" => 85, "img" => "ChatGPT Image 28. Juli 2025, 11_53_02.png"],
    
   ["name" => "AIS", "points" => 280, "img" => "ChatGPT Image 28. Juli 2025, 11_50_43.png"],
    
   ["name" => "Radio", "points" => 450, "img" => "ChatGPT Image 28. Juli 2025, 11_42_18.png"],
   
   ["name" => "Sanitary", "points" => 100, "img" => "ChatGPT Image 28. Juli 2025, 11_40_06.png"],
    ["name" => "Lifejackets", "points" => 800, "img" => "ChatGPT Image 28. Juli 2025, 11_37_49.png"],
     ["name" => "Helmets", "points" => 800, "img" => "ChatGPT Image 28. Juli 2025, 11_29_42.png"],
   
];
   
    
    
    
    
    




            $leaderboard = [
                ["rank" => 1, "medal" => "🥇", "ngo" => "Sea Rescue", "rescued" => 120, "points" => 120],
                ["rank" => 2, "medal" => "🥈", "ngo" => "Open Arms", "rescued" => 95, "points" => 95],
                ["rank" => 3, "medal" => "🥉", "ngo" => "ResQ", "rescued" => 80, "points" => 80],
                ["rank" => 4, "medal" => "", "ngo" => "Solidarity Crew", "rescued" => 60, "points" => 60],
            ];
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Rescue Leaderboard</title>
                <!-- Styles are loaded via main.js (Vite bundle) -->
            </head>
            <body>

                <!-- About / Description (with floating yellow box for title+subtitle) -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-left" style="position:relative;">
                            <span class="floating-title">Rescue Leaderboard<br><span style='font-size:0.7em;font-weight:normal;'>A counter-program to remigration fantasies</span></span>
                            <div style="margin-top:3.5em;">
                                <p>In a political climate increasingly dominated by far-right calls for “remigration” and militarized borders, this project offers a bold and ironic counter-narrative: the Rescue Leaderboard — a public, gamified rewards system for organizations that help people reach safety and claim their right to asylum.</p>
                                <p>Inspired by Ukraine’s <a href="https://brave1.gov.ua/en/" target="_blank">Brave1</a> initiative — where drone operators earn points redeemable for gear — we flip the script: not points for killing, but for rescuing. Every person supported in reaching safety earns points. These points are then redeemable for concrete tools like drones, radios, life jackets, or software — resources used to save even more lives.</p>
                                <p>This is not charity. It’s a pragmatic and radically transparent mechanism to reward and empower those building an open society. If they can gamify deportation, we can gamify rescue.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Leaderboard Table -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-right" style="position:relative;">
                            <span class="floating-title">Leaderboard</span>
                            <p class="has-text-centered has-text-grey" style="margin-top:2.5em;">The game starts in August.</p>
                            <table class="table is-fullwidth game-leaderboard">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>NGO</th>
                                        <th class="has-text-right" style="width:120px;">People Rescued / Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($leaderboard as $entry): ?>
                                        <tr>
                                            <td><?php echo $entry['rank']; ?></td>
                                            <td><?php echo htmlspecialchars($entry['ngo']); ?></td>
                                            <td class="mono has-text-right"><?php echo $entry['rescued']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Shop Section -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-left" style="position:relative;">
                            <span class="floating-title">Rescue Market</span>
                            <div class="columns is-multiline" style="margin-top:2.5em;">
                                <?php foreach ($shop_items as $item): ?>
                                <div class="column is-one-third">
                                    <div class="box has-text-centered" style="font-size:0.9em;">
                                        <?php if (!empty($item['img'])): ?>
                                            <img src="./assets/product_pictures/<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="shop-img" style="margin-bottom:0.5em;max-width:80px;max-height:80px;display:block;margin-left:auto;margin-right:auto;" />
                                        <?php endif; ?>
                                        <h3 class="title is-5" style="font-size:1em; margin-bottom:0.3em;"><?php echo htmlspecialchars($item['name']); ?></h3>
                                        <p style="font-size:0.95em; margin-bottom:0;">Redeem for <?php echo $item['points']; ?> points</p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- FAQ Section -->
                <section class="section">
                    <div class="container">
                        <div class="content-block shift-right">
                            <h2 class="title is-4 has-text-centered">FAQ</h2>
                            <div class="content">
                                <div class="faq-item box" style="margin-bottom:1em; cursor:pointer;" onclick="this.classList.toggle('open')">
                                    <div class="faq-question"><strong>What counts as a ‘rescued person’?</strong></div>
                                    <div class="faq-answer" style="display:none; margin-top:0.5em;">A: Someone who is brought to safety — either by direct SAR or through support to reach their intended country of asylum.</div>
                                </div>
                                <div class="faq-item box" style="margin-bottom:1em; cursor:pointer;" onclick="this.classList.toggle('open')">
                                    <div class="faq-question"><strong>Isn’t this cynical?</strong></div>
                                    <div class="faq-answer" style="display:none; margin-top:0.5em;">A: Yes — because the world is. But if killing earns gear, saving lives should too. We choose solidarity over silence.</div>
                                </div>
                                <div class="faq-item box" style="margin-bottom:1em; cursor:pointer;" onclick="this.classList.toggle('open')">
                                    <div class="faq-question"><strong>How do I donate?</strong></div>
                                    <div class="faq-answer" style="display:none; margin-top:0.5em;">A: Via the platform. All funds are transparently distributed as points to registered NGOs. You’ll see where your money went.</div>
                                </div>
                                <div class="faq-item box" style="margin-bottom:1em; cursor:pointer;" onclick="this.classList.toggle('open')">
                                    <div class="faq-question"><strong>What if NGOs disagree with the system?</strong></div>
                                    <div class="faq-answer" style="display:none; margin-top:0.5em;">A: Participation is voluntary. We are open to feedback and co-design.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <script>
                // FAQ collapse/expand logic
                document.addEventListener('DOMContentLoaded', function() {
                  document.querySelectorAll('.faq-item').forEach(function(item) {
                    item.addEventListener('click', function(e) {
                      if (e.target.closest('.faq-question')) {
                        const answer = this.querySelector('.faq-answer');
                        if (answer.style.display === 'none' || answer.style.display === '') {
                          answer.style.display = 'block';
                        } else {
                          answer.style.display = 'none';
                        }
                      }
                    });
                  });
                });
                </script>

                <!-- Social Media Links & Footer in last box -->
                <section class="section">
                    <div class="container has-text-centered">
                        <div class="content-block shift-left">
                            <h2 class="title is-5">Follow Us</h2>
                            <a href="https://twitter.com/pengcollective" target="_blank" class="button is-link is-light">Twitter</a>
                            <a href="https://instagram.com/peng.collective" target="_blank" class="button is-link is-light">Instagram</a>
                            <a href="https://pen.gg" target="_blank" class="button is-link is-light">Website</a>
                            <div style="margin-top:2em;font-size:0.95em;color:#111;">
                                &copy; 2025 Rescue Leaderboard. Created by <a href="https://pen.gg" target="_blank">Peng Collective</a>.
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Remove separate footer -->
                <button class="floating-donate-btn" onclick="window.open('https://your-donation-link.com', '_blank')">Donate</button>
                <button class="floating-contact-btn" onclick="window.open('https://ucs.pen.gg/nextcloud/apps/forms/s/9fNwRxfTyRyps9NzbC5Xco4w', '_blank')">Contact</button>
                <script type="module" src="/main.js"></script>
            </body>
            </html>
