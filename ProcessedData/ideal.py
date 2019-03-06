import os
import sys
import traceback
import win32com.client #pip install pywin32

import nltk #pip install nltk
#nltk.download('punkt')
#nltk.download('averaged_perceptron_tagger')
#include other ntlk packages, if asked for.

##########################################
#initialized variables
##########################################
question_no_column = 7
start_index = 16


def process_question_paper(ques_paper_path) :
    fd = open(os.path.join(os.getcwd(),"processed_data.csv"),'w')
    headers = "File Name, Question No, SUb Que No., Verbs list"
    fd.write(headers + '\n')
    for root, dirs,files in os.walk(ques_paper_path) :
        for file in files:
            if file.endswith('.xls') :
                file_path = os.path.join(root,file)
                try:
                    excel = win32com.client.Dispatch('Excel.Application')
                    workbook = excel.Workbooks.open(file_path)
                    sheet = workbook.WorkSheets('QuestionPaper')
                    for start_row in range(start_index, 50):
                        try:
                            row, col = start_row, question_no_column
                            question = sheet.Cells(row, col).value

                            if question is not None:
                                row, col = start_row, question_no_column - 2
                                question_no =  sheet.Cells(row, col).value
                                row, col = start_row, question_no_column - 1
                                sub_question_no = sheet.Cells(row, col).value
                                tokens = nltk.word_tokenize(question.lower())
                                text = nltk.Text(tokens)
                                verbs_list = [wrd for (wrd, tags) in nltk.pos_tag(text) if tags in ('VBG')]
                                fd.write(str(file) + ',' + question_no + ',' + sub_question_no + ',' + ' | '.join(verbs_list) + '\n')
                            else:
                                pass


                        except Exception as e:
                            print ("hhj")
                            pass
                    workbook.Close(True)
                except Exception as e:
                    print ("ERROR")
                    pass
    fd.close()





if __name__ == "__main__" :
    arg_cnt = len(sys.argv)
    if arg_cnt > 1:
        ques_paper_path = sys.argv[1]
        process_question_paper(ques_paper_path)
    else:
        print ("Please provide question paper directory path !")

