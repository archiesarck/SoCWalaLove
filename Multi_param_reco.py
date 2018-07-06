
# coding: utf-8

# In[1]:

import sys
from numpy import *
import mysql.connector

uid = int(sys.argv[1])
tid = str(sys.argv[2])

curr_user_index_ratings = 0
curr_user_index_params = 0
num_videos=0
num_users=0

cnx = mysql.connector.connect(user='root', password='',host='127.0.0.1', database='soc')
#cursors :)====================
cursor_num_users = cnx.cursor()
cursor_num_videos = cnx.cursor()
cursor_ratings = cnx.cursor()
cursor_params_matrix = cnx.cursor()
cursor_user_params = cnx.cursor()
cursor_video_index = cnx.cursor()
#=================================

query_num_users = ("select count(*) from users")

cursor_num_users.execute(query_num_users) 
result_num_users = cursor_num_users.fetchall()
for row in result_num_users:
    num_users = row[0]

#total number of users

cursor_num_users.close() 

query_num_videos = ("select count(*) from videos")
cursor_num_videos.execute(query_num_videos) 
result_num_videos = cursor_num_videos.fetchall()
for row in result_num_videos:
    num_videos = row[0]

#total number of videos

cursor_num_videos.close()

#initialize attributes
num_params=6
#[difficulty,relevance,complexity,length,production,engaging]


# In[4]:


#create ratings matrix from database
#old ratings matrix 
#=================================================================
#ratings = random.randint(6, size = (num_videos, num_users), dtype=int)
#ratings
#commenting it out!
#=================================================================
#new ratings
#=================================================================
#take ratings from ratings table in the db!

query_ratings = ("select * from ratings")
cursor_ratings.execute(query_ratings)
ratings = [[0 for i in range(num_videos)] for j in range(num_users)]

#ratings matrix is like:
#       video1 video2 video3 .........................
#user1     0     0      0
#user2     0     0      0
#user3     0     0      0
#.
#.
#.
#it will be fetched by ratings[user][video]

result_ratings = cursor_ratings.fetchall()
for row in result_ratings:
    if(row[0]==uid):
        break
    else:
        curr_user_index_ratings = curr_user_index_ratings + 1


for i in range(num_users):
    for j in range(num_videos):
        ratings[i][j] = result_ratings[i][j+1]
ratings
cursor_ratings.close()
#ratings table updated 
#=================================================================
# In[5]:


#create params_matrix 
#old params_matrix, I will comment this out!
#=================================================================
#params_matrix = random.random(size=(num_videos,num_params))
#params_matrix
#=================================================================
#new params_matrix after taking values from db!
#=================================================================
query_params_matrix = ("select difficulty,relevance,complexity,length,production,engaging from videos")
cursor_params_matrix.execute(query_params_matrix)
result_params_matrix = cursor_params_matrix.fetchall()
params_matrix = [[0 for x in range(num_params)] for y in range(num_videos)]
for i in range(num_videos):
    for j in range(num_params):
        params_matrix[i][j] = result_params_matrix[i][j]
params_matrix
cursor_params_matrix.close()
#params_matrix updated with values from db!
#=================================================================

# In[7]:


#convert params_matrix to unit vectors
for video in range(num_videos):
    norm=linalg.norm(params_matrix[video])
    params_matrix[video][:] = [x / norm for x in params_matrix[video]]
params_matrix


# In[8]:


#load user params
#old user_params, I will comment this out!
#=================================================================
#user_params = random.random(size=(num_users,num_params))
#user_params
#=================================================================
#new user_params after taking values from db!
#=================================================================
user_params = [[0 for x in range(num_params)] for y in range(num_users)]
query_user_params = ("select ID,difficulty,relevance,complexity,length,production,engaging from users")
cursor_user_params.execute(query_user_params)
result_user_params = cursor_user_params.fetchall()
for row in result_user_params:
    if(row[0]==uid):
        break
    else:
        curr_user_index_params = curr_user_index_params + 1


for i in range(num_users):
    for j in range(num_params):
        user_params[i][j] = result_user_params[i][j+1]
user_params
cursor_user_params.close()
#updated user_params from table users!
#=================================================================

#convert user_params to unit vectors

for user in range(num_users):
    norm=linalg.norm(user_params[user])
    if(norm!=0):user_params[user][:] = [x / norm for x in user_params[user]]
user_params


# In[10]:


#rated matrix tells whether a particular movie is rated or not
rated_matrix = [[0 for i in range(num_videos)] for j in range(num_users)]
for i in range(num_users):
    for j in range(num_videos):
        if(ratings[i][j]!=0):rated_matrix[i][j]=1
rated_matrix
#same structure as ratings matrix!

# In[11]:


#get current user index and current topic
#create an array of video indexes video_index[] of all videos belonging 
#to current topic
#such that ratings[user_index][video_index[i]]=0 implies nhy7
#USER is new to the topic

#curr_user_index = already assigned

#we can fetch the index of array row which consists of this 
#uid and the use it in line 193  because it is not neccesary that curr_user_index
#will always be equal to that index, it can be discontinuous!

#curr_topic is replaced by "tid" which we are getting from php file!
def index(x):
    ind = 0
    cursor_index = cnx.cursor()
    cursor_index.execute("select VID from videos")
    result_index = cursor_index.fetchall()
    for i in range(num_videos):
        if(result_index[i][0]==x):ind = i
    cursor_index.close()
    return ind


video_index = []

query_video_index = ("select VID from videos where TID="+tid)
cursor_video_index.execute(query_video_index)
result_video_index = cursor_video_index.fetchall()
#each row[0] contains VID which is related to this topic (tid)
for row in result_video_index:
    if rated_matrix[curr_user_index_ratings][index(row[0])]==0:
        video_index.append(row[0])
video_index
cursor_video_index.close()
#print(video_index)
#in rated_matrix indexing starts from 0 as in an array 
#but in db video_id starts from 1, so row[0]-1!
#nothing to recommend, user have already seen all of then :)    


# In[12]:


#get topic_cost of each video, with respect to curr_topic
#closer two topics are, lower the topic_cost
#create an appropriate function to calculate topic_cost with current_topic
#as argument

# '''topic_cost=random.randint(3,size=(num_videos,),dtype=int)
# topic_cost=topic_cost+ones((size(topic_cost),))
# topic_cost'''


# In[13]:


#get var for each user other than current_user
#var=error*topic_cost summed over each video
#var represents rmse*topic_cost. high var => less effect on prediction
# we can neglect those videos which current_user has not watched
def calc_user_var(curr_user,user_params):
    var_mat = zeros(num_users)
    for user in range(num_users):
        if user == curr_user:
            continue
        else:
            for x in range(num_params):
                var_mat[user] += (user_params[user][x] - user_params[curr_user][x])**2
            
    return var_mat
            


    
# In[14]:


user_var = calc_user_var(curr_user_index_params,user_params)
user_var


# In[15]:


#higher the var, lower the value of that user's prediction
user_val = [1 - x for x in user_var]
user_val


# In[16]:


video_rated = zeros(size(video_index))
p=0
for video in video_index:
    count=0
    for user in range(num_users):
        if user == curr_user_index_ratings:
            continue
        else:
            video_rated[p] += ratings[user][video-1]*user_val[user]
            if rated_matrix[user][video-1] == 1:
                count+=1
    if(count!=0):video_rated[p] /= count
    p+=1
#I hope u understand why I did video-1 !
video_rated
final_array = [x for _,x in sorted(zip(video_rated,video_index),reverse=True)]
#very short code for sorting video_index w.r.t video_rated!
for i in range(size(final_array)):
    print(final_array[i])
#close the db connection!

cnx.close()  
