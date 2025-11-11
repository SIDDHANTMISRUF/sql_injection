# ml/detect.py - detect a query passed as arg
import joblib, sys
vec,clf = joblib.load('ml/detector.pkl')
q = sys.argv[1]
p = clf.predict_proba(vec.transform([q]))[0,1]
print(f"Query: {q}\nMalicious-prob: {p:.3f}")