# British Friends of Kurdistan website

- Repo root: the built static website that the server serves.
- `source/`: the editable source code. Edit here, run `pnpm build`, then copy `source/dist/client/*` to the repo root.
- `HANDOVER.md`: the full developer handover guide.

nginx needs this inside the site's `server {}` block so `/about` loads `about.html`:

    location ~ ^/(source|\.git)(/|$) { return 404; }
    location / { try_files $uri $uri.html $uri/ =404; }
    error_page 404 /404.html;
