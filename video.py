from numpy import *
import mysql.connector

num_params = 6

#connect to the database!
conn = mysql.connector.connect(user='root',password='',host='127.0.0.1',database='soc')
#cursors========================================
cursor_ratings = conn.cursor()
cursor_num_users = conn.cursor()
cursor_num_videos = conn.cursor()
cursor_user_params = conn.cursor()

#num_users======================================
query_num_users = ("select count(*) from users")
cursor_num_users.execute(query_num_users) 
result_num_users = cursor_num_users.fetchall()
for row in result_num_users:
    num_users = row[0]
cursor_num_users.close()

#num_videos===========================================
query_num_videos = ("select count(*) from videos")
cursor_num_videos.execute(query_num_videos) 
result_num_videos = cursor_num_videos.fetchall()
for row in result_num_videos:
    num_videos = row[0]
cursor_num_videos.close()

#ratings ===============================================
query_ratings = ("select * from ratings")
cursor_ratings.execute(query_ratings)
result_ratings = cursor_ratings.fetchall()
user_ratings = [[0 for x in range(num_users)] for y in range(num_videos)]
for i in range(num_videos):
	for j in range(num_users):
		user_ratings[i][j] = result_ratings[j][i+1]
user_ratings
cursor_ratings.close()

#users_params =============================================
query_user_params = ("select difficulty,relevance,complexity,length,production,engaging from users")
cursor_user_params.execute(query_user_params)
result_user_params = cursor_user_params.fetchall()
users_params = [[0 for x in range(num_users)] for y in range(num_params)]
for i in range(num_params):
	for j in range(num_users):
		users_params[i][j] = result_user_params[j][i]
users_params		
cursor_user_params.close()

video_params = [[0 for x in range(num_params)] for y in range(num_videos)]
for i in range(num_videos):
	for j in range(num_params):
		video_params[i][j] = dot(users_params[j][:],user_ratings[i][:])/num_users
video_params		

for video in range(num_videos):
    norm=linalg.norm(video_params[video])
    if(norm!=0):video_params[video][:] = [x / norm for x in video_params[video]]
	else:video_params[video][:] = [-1/(sqrt(6)) for i in range(num_params)]
video_params

params = ['difficulty','relevance','complexity','length','production','engaging']
for i in range(num_videos):
	for j in range(num_params):
		cursor_video_params = conn.cursor()
		cursor_video_params.execute("update videos set "+params[j]+"="+str(video_params[i][j])+" where VID="+str(i+1))
		cursor_video_params.close()

conn.close()