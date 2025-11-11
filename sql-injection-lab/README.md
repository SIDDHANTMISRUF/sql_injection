# SQL Injection Lab (simple)
Steps to run (quick):
1. Make sure Docker and Docker Compose installed.
2. From project root: `docker-compose up --build`
3. Visit http://localhost:8080 in browser.
4. Demo vulnerable login: /login_vuln.php with password "' OR '1'='1"
5. Demo fixed login: /login_fix.php shows no bypass.
6. To reset DB: `docker-compose down -v` then `docker-compose up --build`

Optional ML demo:
- Create logs: `python3 ml/gen_logs.py`
- Install deps: `python3 -m pip install scikit-learn joblib`
- Train: `python3 ml/train_detector.py`
- Detect: `python3 ml/detect.py "SELECT password FROM users --"`

Note: Run only on local machine or isolated VM. Do not attack external sites.
