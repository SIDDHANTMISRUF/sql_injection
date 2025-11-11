# ml/gen_logs.py - generate tiny labeled logs for demo
import random, json, os

os.makedirs('ml', exist_ok=True)
samples = []
benign = ["SELECT * FROM products WHERE name LIKE '%widget%'", "SELECT id FROM users WHERE username='alice'"]
mal = ["' OR '1'='1'", "SELECT password FROM users --", "admin'--"]
for i in range(200):
    if random.random() < 0.3:
        q = random.choice(mal)
        samples.append((q,1))
    else:
        q = random.choice(benign)
        samples.append((q,0))
open('ml/logs.jsonl','w').write('\n'.join(json.dumps({"q":q,"label":l}) for q,l in samples))
print("generated ml/logs.jsonl")