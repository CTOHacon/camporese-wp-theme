---
name: calibrate-skills
description: Modify and improve existing skill files when the user reports mistakes, wants behavior changes, or needs instruction calibration. Use when the user asks to fix, update, or improve how skills guide AI behavior.
---

# Calibrate Skills — Skill Instruction Editor

You are editing **your own instruction files** that control your future behavior. Treat this as prompt engineering on yourself. The goal: make your next iteration produce correct output without bloating context.

## Process

### 1. Diagnose the Root Cause

Before touching any file, identify **why** the mistake happened:

- **Missing rule**: The skill never addressed this case
- **Ambiguous wording**: The instruction could be read multiple ways
- **Wrong default assumption**: The skill implied the opposite behavior
- **Conflicting rules**: Two instructions contradict each other
- **Over-specified**: Too many rules caused the important one to get lost in noise

### 2. Read All Affected Skills

Always read the full skill file(s) before editing. Check for:

- Existing rules that already cover (or conflict with) the change
- The overall structure and how new info fits in
- Redundant or outdated instructions that should be removed

### 3. Apply the Fix — Principles

**Integrate, don't append.** Never bolt a new paragraph onto the end. Find the right structural home for the idea and weave it into existing content.

**Restructure over patch.** If adding the fix makes a section messy, rewrite the section. A clean rewrite that naturally prevents the error beats a list of "don't do X" exceptions.

**Show, don't tell.** A code example with a `✅`/`❌` pattern teaches faster and uses fewer tokens than a paragraph of explanation. Prefer updating existing examples to adding new ones.

**Subtract before adding.** If the new rule makes an old rule redundant, remove the old one. Skills must stay concise — every line competes for attention weight. Aim to keep total line count stable or reduced.

**Use the AI's perspective.** Ask: "If I read this skill cold with no prior context, would I produce the correct output?" If the answer requires reading between the lines, the instruction is too subtle.

**Encode as defaults, not warnings.** Instead of "Don't use X", make the examples and patterns use Y so X never appears as an option. Positive patterns are stronger than prohibitions.

**One source of truth.** Each rule lives in exactly one place. If multiple skills touch the same behavior, pick the primary owner and reference it from others — don't duplicate.

### 4. Verify Consistency

After editing, scan the changed file for:

- Contradictions with the change you just made
- Examples that now demonstrate the wrong pattern
- Descriptions/summaries that no longer match the content

### 5. Update Memory if Needed

If the calibration reveals a pattern that applies beyond skills (e.g., a codebase convention), update `MEMORY.md` or a topic file so the knowledge persists outside skill context.

## Anti-Patterns

- **Parrot patching**: Copy-pasting the user's complaint as a new rule. Rephrase into a structural instruction.
- **Rule stacking**: Adding "also don't forget to..." lines. Instead, fix the root pattern/example.
- **Context bloat**: Skills beyond ~150 lines lose effectiveness. If a skill is growing large, split or compress.
- **Negative-only rules**: Lists of "never do X" without showing what TO do. Always pair with the correct pattern.
