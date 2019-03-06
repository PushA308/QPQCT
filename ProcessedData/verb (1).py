import nltk

helping_verbs = ['am','are','is','was','were','be','being','been','have','has','had','shall','will','do','does','did','may','might','must','can','could','would','should']
sentence = "what is meant by data structure. it has been long time. i didn't do that"

tokens = nltk.word_tokenize(sentence)

tagged = nltk.pos_tag(tokens)
print("tagged tokens:-")
print(tagged)

length = len(tagged) - 1

a = list()

for item in tagged:
    if item[1][0] == 'V':
        if((item[0] in helping_verbs)!=1):
            a.append(item[0])

print(a)
