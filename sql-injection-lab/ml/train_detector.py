# ml/train_detector.py - trains tiny detector using TF-IDF + LogisticRegression
import json
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import LogisticRegression
from sklearn.model_selection import train_test_split
import joblib

data=[json.loads(l) for l in open('ml/logs.jsonl')]
X=[d['q'] for d in data]; y=[d['label'] for d in data]
vec = TfidfVectorizer(ngram_range=(1,2),lowercase=True)
Xv = vec.fit_transform(X)
Xtr,Xte,ytr,yte = train_test_split(Xv,y,test_size=0.2,random_state=42)
clf = LogisticRegression(max_iter=1000).fit(Xtr,ytr)
print("test score:", clf.score(Xte,yte))
joblib.dump((vec,clf),'ml/detector.pkl')
print("saved ml/detector.pkl")