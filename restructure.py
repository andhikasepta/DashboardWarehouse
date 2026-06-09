import sys

with open('c:/Users/User/Downloads/Dashboard/index_backup.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

# Extract the cards by line ranges (0-indexed, so subtract 1 from 1-indexed)
card1 = lines[264:281]
card2 = lines[283:300]
card3 = lines[300:491] # UTILISASI
card4 = lines[495:512]
card5 = lines[514:531]
card6 = lines[531:722] # PERANGKAT OUT

# Change col classes
def change_col(card_lines, new_class):
    for i, line in enumerate(card_lines):
        if 'class="col-xl-' in line:
            card_lines[i] = ' ' * (len(line) - len(line.lstrip())) + f'<div class="{new_class}">\n'
            break
    return card_lines

card1 = change_col(card1, 'col-xl-6 col-lg-6')
card2 = change_col(card2, 'col-xl-6 col-lg-6')

card4 = change_col(card4, 'col-xl-4 col-lg-4')
card5 = change_col(card5, 'col-xl-4 col-lg-4')
card6 = change_col(card6, 'col-xl-4 col-lg-4')

# For card3 (UTILISASI), make it col-xl-3 col-lg-4, and add h-100 to the card, and make body stretch
card3 = change_col(card3, 'col-xl-3 col-lg-4')
for i, line in enumerate(card3):
    if 'class="card shadow mb-4"' in line:
        card3[i] = line.replace('class="card shadow mb-4"', 'class="card shadow mb-4 h-100"')
    elif 'class="card-body"' in line:
        card3[i] = line.replace('class="card-body"', 'class="card-body d-flex flex-column"')
    elif 'class="table-responsive chart-bar"' in line:
        card3[i] = line.replace('class="table-responsive chart-bar"', 'class="table-responsive flex-grow-1"').replace('style="overflow-y: auto;"', 'style="overflow-y: auto; height: 0;"')

new_html = []
new_html.extend(lines[:262])
new_html.append('                    <!-- Content Row -->\n')
new_html.append('                    <div class="row">\n')
new_html.append('                        <!-- Left column -->\n')
new_html.append('                        <div class="col-xl-9 col-lg-8">\n')
new_html.append('                            <div class="row">\n')
new_html.extend(card1)
new_html.extend(card2)
new_html.append('                            </div>\n')
new_html.append('                            <div class="row">\n')
new_html.extend(card4)
new_html.extend(card5)
new_html.extend(card6)
new_html.append('                            </div>\n')
new_html.append('                        </div>\n')
new_html.append('                        <!-- Right column -->\n')
new_html.extend(card3)
new_html.append('                    </div>\n')
new_html.extend(lines[723:])

with open('c:/Users/User/Downloads/Dashboard/index.html', 'w', encoding='utf-8') as f:
    f.writelines(new_html)

print('Success')
