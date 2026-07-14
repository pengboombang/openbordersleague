Sure — here is the full **concept paper** formatted in Markdown, without emojis or emoticons:

```markdown
# Open Borders League  
A counter-program to remigration fantasies

## Summary

In a political climate increasingly dominated by far-right calls for “remigration” and militarized borders, this project offers a bold and ironic counter-narrative: the Open Borders League — a public, gamified rewards system for organizations that help people reach safety and claim their right to asylum.

Inspired by Ukraine’s [Brave1](https://brave1.gov.ua/en/) initiative — where drone operators earn points redeemable for gear — we flip the script: not points for killing, but for rescuing. Every person supported in reaching safety earns points. These points are then redeemable for concrete tools like drones, radios, life jackets, or software — resources used to save even more lives.

This is not charity. It’s a pragmatic and radically transparent mechanism to reward and empower those building an open society.  
If they can gamify deportation, we can gamify rescue.

## The Idea

We track and reward life-saving operations conducted by NGOs helping people on the move — initially focusing on Search and Rescue (SAR) missions in the Central Mediterranean.

- 1 Point = 1 Euro
- 1 person rescued = 1 point
- 1 person reaches the country where they can claim asylum = 1 bonus point

Points can then be exchanged in our Rescue Market — a shop where NGOs can request useful gear to continue their work.

The leaderboard is updated continuously. NGOs can contact us to add themselves or suggest others we may have missed.

## What the Platform Includes

### Home

- Video explainer (satirical but emotionally grounded)
- Call to support open borders and civil rescue efforts
- Donation button

### Scoreboard

- Leaderboard of NGOs and operations
- Number of people supported/rescued
- Points earned and spent

### Market

- Equipment store  
  - Drones (DJI, Searchwing)  
  - Rescue vests  
  - Comms gear (radios, sat phones)  
  - Software tools  
- Points required for each item

## Inspiration

We draw inspiration from:

- **Ukraine’s Brave1 platform**  
  [→ brave1.gov.ua/en](https://brave1.gov.ua/en)  
  A points-based shop where drone units exchange verified kills for gear.

- **Gaming mechanics**  
  Achievement systems and in-game economies (e.g., League of Legends, Football Manager)  
  → “Rescue Manager 2000”, not Border Defense Simulator.

## Political Framing

- A system that rewards rescue over repression
- Makes solidarity visible, measurable, fundable
- Offers a narrative weapon against "remigration"
- Subverts gamified violence with gamified care
- Taps into public desire to contribute to meaningful systems

## Ethical Considerations

We take these concerns seriously:

- **Human lives are not points**  
  The system does *not* individualize or expose vulnerable people. No GPS logs, no mission-specific metadata. Only anonymized totals.

- **Avoiding perverse incentives**  
  Points are symbolic and follow real-world rescue efforts, not the other way around.

- **Avoid techno-solutionism**  
  This system complements existing practices. It doesn’t replace solidarity with stats — it makes solidarity more visible and fundable.

- **No encrypted radios in Gaza or high-risk zones**  
  We won't provide tools that could endanger people via interception.

## Timeline (ambitious, flexible)

| Week     | Milestone                                    |
|----------|----------------------------------------------|
| KW 25    | Write concept paper · First meeting with NGOs |
| KW 26–27 | Gather feedback · Develop final concept       |
| KW 28–29 | Build website · Write copy · Shoot video      |
| KW 30    | Prepare release                               |
| KW 31–32 | Launch                                        |

## Next Steps

- Write short concept version for outreach
- Hold feedback meeting with SAR NGOs
- Confirm how rescue data will be collected (no surveillance logs)
- Define which equipment will be available in store
- Build basic website with 3 sections: Home, Scoreboard, Market
- Create donation system with optional gamified bonuses
- Write FAQ (e.g. "What counts as rescue?", "How do I donate?", "Where does my money go?")

## FAQs (Draft)

**Q: What counts as a ‘rescued person’?**  
A: Someone who is brought to safety — either by direct SAR or through support to reach their intended country of asylum.

**Q: Isn’t this cynical?**  
A: Yes — because the world is. But if killing earns gear, saving lives should too. We choose solidarity over silence.

**Q: How do I donate?**  
A: Via the platform. All funds are transparently distributed as points to registered NGOs. You’ll see where your money went.

**Q: What if NGOs disagree with the system?**  
A: Participation is voluntary. We are open to feedback and co-design.

## Technical Concept

### Overview
This project is a simple leaderboard website. It is built using only HTML and enhanced with a modern CSS framework for a visually appealing and responsive design. No backend or JavaScript frameworks are used, making it lightweight and easy to maintain.

### Technology Stack
- **HTML5**: For the website structure and content.
- **CSS Framework**: A popular, easy-to-use CSS framework such as [Bulma](https://bulma.io/), [Bootstrap](https://getbootstrap.com/), or [Tailwind CSS](https://tailwindcss.com/) will be used to provide a clean and modern look with minimal effort.

### Deployment
- The site will be deployed using **GitHub Pages** for free, static hosting. This allows for easy updates and version control via GitHub.

### Key Features
- Simple, static leaderboard page
- Responsive design for mobile and desktop
- Easy to update by editing the HTML file

### How to Deploy
1. Push the website files (HTML, CSS) to a GitHub repository.
2. Enable GitHub Pages in the repository settings, selecting the `website` folder containing the site files.
3. The site will be available at `https://<username>.github.io/<repository>/`.

## Possible Site Structure

The website is organized as follows:

```
website/
├── assets/
│   └── style.css         # Custom styles
├── dist/                 # Production build output (generated by Vite)
├── index.html            # Main HTML file
├── main.js               # Entry point for JS and CSS imports
├── package.json          # Project dependencies and scripts
├── vite.config.js        # Vite configuration
└── node_modules/         # Installed npm packages
```

- All source files are in the `website/` directory.
- Static assets (images, styles) go in `website/assets/`.
- The production-ready site is generated in `website/dist/` after running `npm run build`.

## Possible Content Structure

A simple leaderboard site could be structured with the following sections:

- **Header**: Site title or logo
- **Leaderboard Table**: Main content showing ranks, names, and scores
- **About/Description**: Short description or rules (optional)
- **Shop**: Section listing items (e.g., DJI Mavic, lifewest, etc.)
- **FAQ**: Frequently Asked Questions section
- **Social Media Links**: Links to social media profiles
- **Footer**: Copyright, credits (Peng Collective / pen.gg), and contact info

Example layout:

```
+-------------------------------+
|         Header                |
+-------------------------------+
|      Leaderboard Table        |
+-------------------------------+
|  About / Description (opt.)   |
+-------------------------------+
|           Shop                |
+-------------------------------+
|            FAQ                |
+-------------------------------+
|     Social Media Links        |
+-------------------------------+
|           Footer              |
+-------------------------------+
```

This site is intentionally simple and does not include user profiles or login functionality.

You can expand this with more sections, such as:
- Announcements or news

---

**This website is created by the [Peng Collective](https://pen.gg).**

## Closing Line

In 2025, the right is pushing deportation as a moral duty.  
We push back — by rewarding those who help people stay alive.  
Let’s gamify solidarity. Let’s rank rescue. Let’s reward hope.

## Design & Corporate Identity (CI)

The design is inspired by the Brave Market (brave1.gov.ua/en):

- **Content Blocks**: All main content appears in white blocks, each horizontally shifted (alternating left/right) for a dynamic, modern look.
- **No Border Radius**: All elements have sharp, square corners—no border radius anywhere.
- **Font**: Uses a modern digital font. For best results, use a font similar to Brave1's 'familybravemedium'.
- **Highlighting**: Important text and the logo are placed in a yellow box with black text for maximum contrast and attention.
- **Background**: The site background is solid black for a bold, high-contrast appearance.

### Implementation Notes
- Use CSS Flexbox or Grid to achieve the horizontal shifting of white blocks.
- Use a web font for the digital look (e.g., 'Orbitron', 'Share Tech Mono', or custom if available).
- Yellow highlight: `background: #ffe600; color: #111;` (or similar for accessibility).
- All content blocks: `background: #fff; color: #111; box-shadow: none; border-radius: 0;`.
- Body background: `background: #111;` (or pure black).

---

This design ensures a modern, digital, and bold appearance, closely referencing the Brave Market style.

## Game-Style Leaderboard Design

The leaderboard should visually resemble a game leaderboard:

- **Digital/Arcade Font**: Use a digital or arcade-style font for all leaderboard text (e.g., 'Orbitron', 'Share Tech Mono', or similar).
- **High Contrast**: Use black background, white leaderboard block, and bold yellow highlights for top ranks.
- **No Border Radius**: All corners are sharp.
- **Row Highlighting**: Top 3 ranks are visually highlighted (e.g., gold, silver, bronze backgrounds or icons).
- **Monospaced Numbers**: Scores and ranks use a monospaced or digital font for a scoreboard effect.
- **Icons/Badges**: Optionally, add icons (trophy, medal, etc.) for top ranks.
- **Column Layout**: Columns for Rank, NGO, People Rescued, Points, and optional badge/icon.

---

**Implementation:**
- Use CSS classes for row highlighting and digital font.
- Add trophy/medal icons for top 3 rows.
- Use bold yellow for the #1 rank, silver for #2, bronze for #3.
- All numbers are right-aligned and monospaced.

This will make the leaderboard feel more like a game or e-sports scoreboard, increasing engagement and clarity.
```

Let me know if you’d like this saved as a `.md` file or prepared for a website or print layout.
