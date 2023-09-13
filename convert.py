import os
import sys
import markdown
import frontmatter

if len(sys.argv) != 2:
    print("Usage: python3 build.py <markdown_file>")
    sys.exit(1)

markdown_file = sys.argv[1]

output_dir = "build"


with open("template.html", "r", encoding="utf-8") as template_file:
    template = template_file.read()

filename_no_extension = os.path.splitext(os.path.basename(markdown_file))[0]

with open(markdown_file, "r", encoding="utf-8") as md_file:
    content = md_file.read()
    post = frontmatter.loads(content)

title = post.get("title", filename_no_extension)

html_content = markdown.markdown(post.content)

template_with_content = template.replace("{{ TITLE }}", title).replace("{{ CONTENT }}", html_content)

with open(os.path.join(output_dir, f"{filename_no_extension}.html"), "w", encoding="utf-8") as html_file:
    html_file.write(template_with_content)

print("Done")
