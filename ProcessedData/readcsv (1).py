import csv
f = open("bloom verbs.csv","r")
reader = csv.reader(f)
#included_cols = [1]
word ='ARgued'
i=1
a=list()
row = next(reader)
for row in reader:
    if word.lower() in row:
        a.append(i)
    i=i+1
print(a)
f.close()
