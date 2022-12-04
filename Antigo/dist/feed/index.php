<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Twitter Clone UI build with TailwindCSS and AlpineJS</title>
  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<style>
		[x-cloak] {
			display: none;
		}

	</style>
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<script>
	var i = false;
	function myfunction(){
		var i = !i;
		
		if(i){
			
		}
	}

</script>
<body class="antialiased sans-serif bg-gray-200" id="testee">
	<div x-data="app()" x-cloak>
		<div class="bg-white shadow" id="teste1-1">
			<div class="container mx-auto px-4 py-2 md:py-3"  id="teste1">
				<div class="flex justify-between items-center">
					<div class="text-lg md:text-xl font-bold text-gray-800" id="social">Social Academy</div>
					<div class="relative" x-data="{ open: false }" x-cloak>
						<div @click="open = !open"
							class="cursor-pointer font-bold w-10 h-10 bg-blue-200 text-blue-600 flex items-center justify-center rounded-full">
							A
						</div>

						<div x-show.transition="open" @click.away="open = false"
							class="absolute top-0 mt-12 right-0 w-48 bg-white py-2 shadow-md border border-gray-100 rounded-lg z-40">
							<a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Edit
								Profile</a>
							<a href="#"
								class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Account
								Settings</a>
							<a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Sign
								Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container mx-auto px-4 py-10"  id="teste2">
			<div class="md:flex -mx-4">
				<div class="md:w-2/4 px-4" id="centralizar">
					<div class="bg-white rounded-lg shadow p-6 mb-8">
						<div class="flex w-full">
							<div class="flex-shrink-0 mr-5">
								<div class="cursor-pointer font-bold w-12 h-12 bg-gray-300 flex items-center justify-center rounded-full">
									<span x-text="generateAvatarFromName('Current User')" class="uppercase text-gray-700"></span>
								</div>
							</div>
							<div class="flex-1">
								<textarea x-model="tweetText" 
									class="mb-2 bg-gray-200 focus:outline-none focus:shadow-outline focus:bg-white border border-transparent rounded-lg py-2 px-4 block w-full appearance-none leading-normal placeholder-gray-700" 
									:class="{'border border-red-500': tweetIsOutOfRange() && tweetText.length != 0 }"
									rows="3"
									placeholder="Inicie um debate!"></textarea>

									<div class="relative w-auto mb-2 border rounded-lg relative bg-gray-100 mb-4 shadow-inset overflow-hidden" x-show="images.length > 0">
										<div class="gg-container">
											<div class="gg-box square-gallery" style="margin: 0">
												<template x-for="image in images">
													<img class="object-cover w-full" :src="image" />
												</template>
											</div>
										</div>
										<div @click="images = []; document.getElementById('fileInput').value = ''" class="shadow cursor-pointer absolute top-0 right-0 p-2 mr-2 mt-2 rounded-full bg-gray-600">
											<svg class="h-6 w-6 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
											  </svg>								  
										</div>
									</div>
			
									<input multiple name="photo" id="fileInput" accept="image/*" class="hidden" type="file" @change="let files = document.getElementById('fileInput').files; 
										for (var i = 0; i < files.length; i++) {
												var reader = new FileReader();
												reader.onload = (e) => images.push(e.target.result);
												reader.readAsDataURL(files[i]);
										}
									">
									
									<div class="flex justify-between items-center">
										<div>
											<label 
												for="fileInput"
												type="button"
												class="-ml-2 cursor-pointer inine-flex justify-between items-center focus:outline-none p-2 rounded-full text-gray-500 bg-white hover:bg-gray-200"
											>
												<svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
												  </svg>  
											</label>
										</div>
										<div>
											<span :class="{ 'text-red-600': charactersRemaining() <= 20 && charactersRemaining() > 10, 'text-red-400': charactersRemaining() <= 10 }" class="mr-3 text-sm text-gray-600" x-text="charactersRemaining()"></span>
			
											<button
												@click="saveTweet()"
												:disabled="(tweetText == '') || tweetIsOutOfRange()"
												:class="{'cursor-not-allowed opacity-50': (tweetText == '') || tweetIsOutOfRange()}"
												type="button"
												class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
											>Publicar</button>
										</div>
									</div>
							</div>
						</div>

					</div>

					<ul class="bg-white rounded-lg shadow mb-8">
						<template x-for="(tweet, tweetIndex) in tweets" :key="tweetIndex">	
							<div>
								<li class="px-6 py-5" :class="{'border-b border-gray-200': (tweetIndex + 1) != tweets.length }">
									<div class="flex w-full">
										<div class="flex-shrink-0 mr-5">
											<div class="cursor-pointer font-bold w-12 h-12 bg-gray-300 flex items-center justify-center rounded-full">
												<span x-text="generateAvatarFromName(tweet.name)" class="uppercase text-gray-700"></span>
											</div>
										</div>
										<div class="flex-1">
											<div>
												<strong class="font-bold text-gray-800 mr-2" x-text="tweet.name"></strong> 
												<span x-text="tweet.username" class="text-gray-600"></span>
												<span class="mx-1 text-gray-500">&bull;</span>
												<span class="text-gray-600" x-text="formatDate(tweet.date)"></span>
											</div>

											<div class="mb-4">
												<p x-text="tweet.tweet" class="text-gray-700"></p>
											</div>
											 
											<div class="relative w-auto mb-2 border rounded-lg relative bg-gray-100 mb-4 shadow-inset overflow-hidden" x-show="tweet.tweet_images.length > 0">

												<div class="gg-container">
													<div class="gg-box square-gallery" style="margin: 0">
														<template x-for="image in tweet.tweet_images"> 
															<img class="object-cover w-full" :src="image" />	 
														</template>
													</div>
												</div>
											</div>

											<div class="flex items-center w-full">
												
												<div class="w-1/2 flex items-center">
													<div onclick="myfunction()" class="cursor-pointer hover:bg-gray-200 inline-flex p-2 rounded-full duration-200 transition-all ease-in-out">
														<svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
														</svg>													  
													</div>
												</div>

												<!--
													<div class="w-1/4 flex items-center">
														<div @click="retweet(tweetIndex, tweet.retweets)" class="cursor-pointer hover:bg-gray-200 inline-flex p-2 rounded-full duration-200 transition-all ease-in-out">
															<svg class="h-6 w-6" :class="{'text-gray-500': tweet.hasBeenRetweeted == false, 'text-green-500': tweet.hasBeenRetweeted == true }"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
																<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
															</svg>													  
														</div>
														<div x-text="tweet.retweets" class="ml-1 leading-none inline-flex" :class="{'text-gray-600': tweet.hasBeenRetweeted == false, 'text-green-600': tweet.hasBeenRetweeted == true}"></div>
													</div>
												-->

												<div class="w-1/2 flex items-center">
													<div @click="likeTweet(tweetIndex)" class="cursor-pointer hover:bg-gray-200 inline-flex p-2 rounded-full duration-200 transition-all ease-in-out">
														<svg x-show="tweet.hasBeenLiked == false" class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
														</svg>

														<svg x-show="tweet.hasBeenLiked == true" class="h-6 w-6 text-red-500"  viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
													</div>
													<div x-text="tweet.likes" class="ml-1 text-gray-600 leading-none inline-flex" :class="{'text-gray-600': tweet.hasBeenLiked == false, 'text-red-600': tweet.hasBeenLiked == true}"></div>
												</div>

												<!--
													<div class="w-1/3 flex items-center">
														<div class="cursor-pointer hover:bg-gray-200 inline-flex p-2 rounded-full duration-200 transition-all ease-in-out">
															<svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
																<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
															</svg>
														</div>
													</div>	
												-->

											</div>
										</div>
									</div>
								</li>
							</div>
						</template>
					</ul>
				</div>

				<!--
					<div class="md:w-1/3 px-4">
					<ul class="bg-white rounded-lg shadow mb-8">
						<li class="px-6 py-3 border-b border-gray-200">
							<div class="font-bold text-gray-800">Who to follow</div>
						</li>
						<template x-for="(followersSuggestion, followersSuggestionIndex) in followersSuggestions" :key="followersSuggestionIndex">	
							<li class="px-6 py-3" :class="{'border-b border-gray-200': (followersSuggestionIndex + 1) != followersSuggestions.length }">
								<div class="flex w-full">
									<div class="flex-shrink-0 mr-5">
										<div class="cursor-pointer font-bold w-12 h-12 bg-gray-300 flex items-center justify-center rounded-full">
											<span x-text="generateAvatarFromName(followersSuggestion.name)" class="uppercase text-gray-700"></span>
										</div>
									</div>
									<div class="flex-1 flex flex-row justify-between items-center">
										<div>
											<p x-text="followersSuggestion.name" class="text-gray-700"></p> 
											<p x-text="followersSuggestion.username" class="text-gray-500"></p>
										</div> 
										<div>
											<button
												@click="follow(followersSuggestion.username)"
												class="focus:outline-none py-1 px-4 rounded-full shadow-sm text-center text-blue-600 bg-white hover:bg-blue-100 font-medium border border-blue-200" 
											>Follow</button>
										</div>
									</div>
								</div>
							</li>
						</template>
					</ul>

					<ul class="bg-white rounded-lg shadow mb-8">
						<li class="px-6 py-3 border-b border-gray-200">
							<div class="font-bold text-gray-800">Following</div>
						</li>
						<template x-for="(following, followingIndex) in followings" :key="followingIndex">	
							<li class="px-6 py-3" :class="{'border-b border-gray-200': (followingIndex + 1) != followings.length }">
								<div class="flex w-full">
									<div class="flex-shrink-0 mr-5">
										<div class="cursor-pointer font-bold w-12 h-12 bg-gray-300 flex items-center justify-center rounded-full">
											<span x-text="generateAvatarFromName(following.name)" class="uppercase text-gray-700"></span>
										</div>
									</div>
									<div class="flex-1 flex flex-row justify-between items-center">
										<div>
											<p x-text="following.name" class="text-gray-700"></p> 
											<p x-text="following.username" class="text-gray-500"></p>
										</div> 
										<div>
											<button
												@click="unfollow(following.username)"
												class="focus:outline-none py-1 px-4 rounded-full shadow-sm text-center text-blue-600 bg-white hover:bg-blue-100 font-medium border border-blue-200" 
											>Unfollow</button>
										</div>
									</div>
								</div>
							</li>
						</template>
					</ul>
				</div>			
				-->
				
			</div>
		</div>
	</div>

	<script>
		const MAX_TWEET_LENGTH = 1000;
		const MONTH_NAMES = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

		function app() {
			return {
				tweetText: '',
				images: [],

				tweets: [
					{
						name: "John Wick",
						username: "@john1123wick",
						tweet: 'Build your own Fake Twitter Post now! Check it out @simitator.com',
						retweets: 12,
						likes: 50,
						date: "2020-04-06 12:00:00",
						tweet_images: [],
						hasBeenLiked: false,
						hasBeenRetweeted: false
					},
					{
						name: "Captain America",
						username: "@capAmerica",
						tweet: 'Prank your friends or imitate celebrities. You can make fake twitter tweets in any creative way you like. Upload profile picture, select username, write message...',
						retweets: 10,
						likes: 100,
						date: "2020-04-02",
						tweet_images: [],
						hasBeenLiked: false,
						hasBeenRetweeted: false
					}
				],
				
				followersSuggestions: [
					/*
					{
						name: "ABC Name",
						username: "@hello_abc"
					},
					{
						name: "CDE Name",
						username: "@hello_cde"
					},
					{
						name: "XYZ Name",
						username: "@hello_xyz"
					}
					*/
				],

				followings: [
					/*
					{
						name: "PQR Name",
						username: "@hello_pqr"
					},
					{
						name: "LMNO Name",
						username: "@hello_lmno"
					}
					*/
				],
				
				follow(username) {
					let getIndexOfSuggestion = this.followersSuggestions.findIndex(f => f.username === username);
					this.followings.push(this.followersSuggestions[getIndexOfSuggestion]);

					// remove from Followers Suggestions array
					this.followersSuggestions.splice(getIndexOfSuggestion, 1);
				},

				unfollow(username) {
					let getIndexOfFollower = this.followings.findIndex(f => f.username === username);
					this.followersSuggestions.push(this.followings[getIndexOfFollower]);

					// remove from followings array
					this.followings.splice(getIndexOfFollower, 1);
				},

				saveTweet() {
					this.tweets.unshift({
						name: "Current User",
						username: "@current_user",
						tweet: this.tweetText,
						retweets: 0,
						likes: 0,
						date: new Date(),
						tweet_images: this.images,
						hasBeenLiked: false,
						hasBeenRetweeted: false
					});

					this.images = [];
					this.tweetText = '';
				},

				retweet(index) {
					this.tweets[index].hasBeenRetweeted ? this.tweets[index].retweets-- : this.tweets[index].retweets++;
					this.tweets[index].hasBeenRetweeted = !this.tweets[index].hasBeenRetweeted;
				},

				likeTweet(index) {
					this.tweets[index].hasBeenLiked ? this.tweets[index].likes-- : this.tweets[index].likes++;
					this.tweets[index].hasBeenLiked = !this.tweets[index].hasBeenLiked;
				},

				charactersRemaining() {
					return MAX_TWEET_LENGTH - this.tweetText.length;
				},

				tweetIsOutOfRange() {
					return (MAX_TWEET_LENGTH - this.tweetText.length) == MAX_TWEET_LENGTH || (MAX_TWEET_LENGTH - this.tweetText.length) < 0;
				},

				generateAvatarFromName(name) {
					return name.split(" ")[0].slice(0, 1) +''+ name.split(" ")[1].slice(0, 1);
				},

				formatDate(date) {
					if (!date) {
    					return null;
 	 				}
					
					const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
					const today = new Date();
					const yesterday = new Date(today - DAY_IN_MS);
					const d = new Date(date);
					const day = d.getDate();
  					const month = MONTH_NAMES[d.getMonth()];

					const seconds = Math.round((today - d) / 1000);
  					const minutes = Math.round(seconds / 60);
					const hours = Math.round(minutes / 60);

					const isToday = today.toDateString() === d.toDateString();
					// const isYesterday = yesterday.toDateString() === date.toDateString();
					// const isThisYear = today.getFullYear() === date.getFullYear();
					
					if (isToday) {
						if (seconds < 5) {
							return 'now';
						} else if (seconds < 60) {
							return `${ seconds }s`;
						} else if (minutes < 60) {
							return `${ minutes }m`;
						} else {
							return `${ hours }h`;
						}
					} else {
						return month +' '+ day;
					}
				}
			}
		}
	</script>
</body>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
