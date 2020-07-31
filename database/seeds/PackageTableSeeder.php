<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Package::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Package::insert([
            ['title' => 'Premium SEO Article Writing Service','slug'=>'premium-seo-article-writing-service', 'type'=>'article', 'price'=>'0.04', 'direct_posting_price'=>null, 'image_path'=>'global/img/packages/premium-seo-article-writing-service.jpg',
                'description'=>'
                    About our Premium SEO Article Writing Service
                    Are you tired of not being able to find high quality SEO copywriting for your business at an affordable rate? Writer Army is your source for affordable basic and premium SEO articles for your website or online marketing campaigns written exclusively by professional US SEO copywriters.

                    Our Premium SEO articles are substantially higher in quality than our Basic SEO articles and are a great choice for articles that require in-depth research, a compelling and interesting format, or more details than a basic article. This service is a good choice for more technical articles, product reviews, content to be published on a premium website, content for an online resource library, and many other types of detailed articles.

                    Your business needs affordable high quality and compelling premium SEO content that will bring readers back to your website time and time again, and content that is optimized properly by experts who understand how an SEO article should be structured. Gaining a high ranking on search engines is critical to the success of your business, and quality SEO copywriting will help you reach your ranking goals.

                    Writer Army has American writers and professional SEO editors who are highly experienced at writing high quality and compelling SEO content. Our premium SEO content is optimized with your preferred keywords naturally based on the latest best SEO practices. Our writers will spend extra time on your premium SEO content order to ensure that it is written to be engaging and compelling.

                    What’s included in our premium SEO copywriting service:
                    Highly detailed 100% unique premium content
                    Written by an experienced SEO copywriter from our team
                    Each article topic is researched extensively
                    Written in an compelling and interest driving format and voice
                    Formatted and optimized for publishing directly on websites
                    Secondary keyword optimization included for free
                    Turnaround time of 5-7 business days or less
                    How our premium SEO article copywriting service benefits you
                    We will assign your project only to experienced SEO writers. Our American SEO copywriters are highly experienced at creating high quality compelling SEO content with the proper keyword densities, natural integration of primary and secondary LSI keywords, and a compelling format that will drive interest and sales to your business.

                    Not only will this content help you drive more traffic to your business with better SEO rankings, you will also get the benefit of having high quality and interesting content available to your readers which will drive long term interest to your website and brand. It is this type of premium content that visitors from search engines will find interesting and will share with their friends on social media, increasing exposure to your brand.

                    We have been able to strike a perfect balance of affordability and quality that you won’t be able to find elsewhere. We also offer article posting and on-page optimization services to save you even more time and money, allowing you to focus on the most important aspects of your business.
            '],

            ['title' => 'Premium Blog Post Writing Service','slug'=>'premium-blog-post-writing-service', 'type'=>'article', 'price'=>'0.06', 'direct_posting_price'=>null, 'image_path'=>'global/img/packages/premium-blog-post-writing-service1.jpg',
                'description'=>'
                    About our Premium Blog Post Copywriting Service
                    Premium blog posts are topic oriented blog articles that are intended for publishing on WordPress or any other blogging platform. Premium blog posts are written by our best writers and they are written to be conversational and engaging to readers. They are typically used to promote your business’s brand an establish a consistent readership base on your website, while also helping your website rank for its main keywords.

                    Great blog content serves your business many ways. If it is a popular post it can be syndicated across dozens or even hundreds of related websites. Blog content regularly ranks highly in Google for relevant search terms, particularly if the blog post partially covers a recent news story in your industry.

                    The blog writers at Writer Army have written for several different industries and we will assign your blog posts to writers with the most experience in your particular industry. Our Premium blog posts go through several rounds of revisions and editing to ensure that they are as high in quality as possible before they are sent out to you.

                    On the form above we ask you for as many details as you can provide us regarding your company’s unique brand and identity so that our writers can become acquainted with your unique voice. And we write our blogs to match your company voice and perspective as much as we humanly can.

                    We also can upload your Premium blog posts to your blog and optimize them using WordPress SEO or any other plugin or tool that you prefer to use for a small additional charge per blog post. Ongoing Premium blog posting and management can also be arranged at a discounted rate.

                    What’s included in our Premium blog post writing service

                    Your Premium blog post order comes with the following:

                    Each post is designed to be interesting and engaging to your readers
                    Written to create a readership base for your business
                    100% original and thoroughly researched
                    Written in your unique company voice
                    Can be search engine optimized by your request
                    Turnaround time of 5-7 business days
                    How our premium blog post writing service benefits you
                    There is simply no business that can afford to miss out on the many opportunities to increase their customer base and get brand exposure by blogging. Our blog posts will help establish your business as a leader in its market and each topic will be thoroughly researched and written from an educated perspective by our most talented and experienced American blog writers.

                    We have several years of experience in creating high quality and compelling blogging campaigns for our clients that have helped build their brand and have generated more traffic leads and ultimately sales to their websites.

                    The more that you utilize your business’s blog, the more that you will increase your readership base, the higher rankings that you will get on the search engines, and the greater the chance that one of your blog posts will be syndicated across multiple websites, creating valuable backlinks to your website and exposure to your brand.
            '],

            ['title' => 'Website Copywriting Service','slug'=>'website-copywriting-service', 'type'=>'article', 'price'=>'0.10', 'direct_posting_price'=>null, 'image_path'=>'global/img/packages/website-copywriting-service.jpg',
                'description'=>'
                    Your business is represented to potential customers by your website, and the text that you display on your website is one of the most important factors that influence your potential customers’ buying decision. Great website copy can convert your visitors into leads and sales, while mediocre website copy will rarely convert to leads.

                    You need to have a compelling message on your website that is well written and concise, that represents your brand, and that will get your visitors interested in your product or service.

                    You would select this service if you need any text for your website’s pages such as your Homepage, About Us page, Services page, Products page, FAQ page or any other main page or sub-page of your website.

                    Writer Army can create a high converting message for your website

                    Writer Army has experienced copywriters who can create a high converting sales message that will drive leads and more sales to your business at an affordable rate. The copywriters at Writer Army have several years of experience in web copywriting and know how to craft a message that will drive more targeted interest to your business.

                    Even better, our copywriters are experienced in SEO and will ensure that your website text is properly optimized for your business’s main keywords. Your business’s brand will be promoted in its best possible light and your visitors will get a compelling message that will drive them to find out more information from you or make a purchase right on the spot.

                    What’s included in our service

                    You get the following included with our website copywriting service:

                    Free search engine optimization for your chosen keywords
                    Includes information specific to your business
                    Guaranteed to be 100% original or your money back
                    Multiple rounds of revisions to ensure the highest quality possible
                    Broken up into headers and bullets for readability
                    Completed within 5-7 business days or sooner
                    How our web copy service benefits you

                    The web copy that we create for you will produce revenue for your business now and in the future and will be a valuable asset to your business and online presence. Our expert copywriters will produce search engine optimized high converting web pages that are tailored to your unique business and written in your unique voice. Your web copy will be revised multiple times to get a refined and concisely written piece of copy that you can be proud to use to represent your business.

                    Our US copywriters have extensive experience in writing for many different types of business, and we will do the research necessary to get acquainted with your particular business. Our expert copywriters understand what it means to produce great web copy that converts to leads and sales, and we will take the time needed to craft refined, compelling and high quality website copy for your online or offline business.
            '],

            ['title' => 'Email Newsletter Writing Service','slug'=>'email-newsletter-writing-service', 'type'=>'article', 'price'=>'0.10', 'direct_posting_price'=>null, 'image_path'=>'global/img/packages/email-newsletter-writing-service.png',
                'description'=>'
                    Email newsletters are critical for establishing a consistent relationship with your marketing list. They must be carefully researched and written to be interesting and intriguing to your readers so that they are excited for the next newsletter. They offer you a way to establish a consistent connection with your market that you can use to generate extra revenue for your business at almost any time.

                    Email marketing continues to be one of the most effective ways to build a business, and our expert US sales copywriters can create compelling email newsletters for you that will keep your list interested in what you have to say so that you can utilize this powerful channel of communication to get more leads for your business.

                    We write your email newsletter in the specific tone of your business and we will look at previous emails to your customers to ensure that the tone remains consistent throughout all the newsletters that we produce for you. At your request we can make the newsletters more sales oriented or we can make them more informational in nature.

                    Whether you need a weekly, bi-monthly or monthly newsletter, we can help you with your needs and produce a consistently high level of quality newsletters for you. Only our best copywriters will be hired to work on your email newsletters as it takes sufficient skill to be able to craft a compelling message in a concise email that will keep your customers interested. We will spend the extra effort needed to create a succinct and effective email message.

                    What’s included in our email newsletter writing service
                    We include the following with each email newsletter order:

                    Newsletters written to be concise, compelling and effective
                    Written in your unique company voice
                    Original and well researched
                    Consistent with the tone of your prior email newsletters
                    Written by our best sales copywriters
                    Can be designed as either a sales message or informational newsletter
                    How our email newsletter writing service benefits you
                    By establishing a relationship with your list using high quality newsletters you will help make them more receptive to promotions and sales offers from your business. We will supply you with industry specific newsletters that your readers will find interesting and as a result they will stay subscribed to your list. The more leads that you have in your business the more opportunities that you have to make money, and our email newsletters will help you capitalize on the income earning potential of your email list.

                    Email marketing remains a powerful vehicle to establish trust with current and potential customers and make sales. Creating a high quality email newsletter takes time, and by hiring Writer Army to create your email newsletters you will not only save time, but our copywriting experts will create a newsletter or email sales letter that will exceed your expectations and help you build a positive connection with your customers that will benefit your business both in the short term and long term.
            '],

            ['title' => 'Sales Letter Copywriting Service','slug'=>'sales-letter-copywriting-service', 'type'=>'article', 'price'=>'0.10', 'direct_posting_price'=>null, 'image_path'=>'global/img/packages/sales-letter-copywriting-service.jpg',
                'description'=>'
                    A great sales letter can make or break your business, and at Writer Army we have experienced US copywriters who can craft a engaging and high converting sales letter for your product or service. Your sales letter is one of the most critical components of your business because your customers are converted to leads and sales through it. Hiring us to create a quality sales letter for you will pay off in both the short and long term, as our expert copywriters will work with you to ensure that your sales letter is exactly as you want it to be.

                    At Writer Army we have experience writing for many different types of products and services and by filling out the form above we will have enough information to get started on drafting a high quality sales letter for you. We will also send you a separate optional questionnaire that you can fill out at your own convenience which will help provide us with some extra details about unique aspects of your business that we will integrate into your sales letter.

                    We can handle any type of sales letter order written in any particular voice or format that you prefer for your business, whether it is professional or casual, as a story or a conversation with the customer or as more of an informational letter, or any other tone that you might need. Our sales letter copywriters have written for a wide range of industries but they will research your particular industry and business extensively so that they are writing your letter from an educated perspective.

                    What’s included in our sales letter copywriting service

                    We include the following with each sales letter order:

                    Sales letter written in your preferred voice and tone
                    Form and optional questionnaire are used to cover unique aspects of your business
                    Your market, competitors and business are researched by our copywriters
                    Sales letter is crafted to be compelling to compel your target audience to contact you or buy from you
                    Written by experienced US sales copywriters
                    Turnaround time of 7-10 business days or sooner
                    How our sales letter copywriting service benefits you

                    We will spend the time to ensure that your sales letter is as compelling, high converting, and interesting as it can possibly be, so that you have a piece of sales copy that will become a valuable asset for you. We will make sure that the core message of your business is communicated to your potential customers in the most concise yet compelling way possible so that they are prompted to take action right away, whether it is by emailing you, calling you, or making a purchase right on the spot.

                    We will include the emotional triggers and compelling voice that is needed to drive your visitors to pick up the phone or make a purchase right then and there. You will be more than satisfied with the both the quality of our sales copy and the speed that we can produce it for you. We understand that the purpose of your sales letter is to make sales either immediately or through generating leads, and you can rest assured that we will have that exact purpose in mind as we create your unique sales letter.
            '],

            ['title' => 'Press Release Writing Service','slug'=>'press-release-writing-service', 'type'=>'article', 'price'=>'0.12', 'direct_posting_price'=>null, 'image_path'=>'global/img/packages/press-release-writing-service.jpg',
                'description'=>'
                    You may be aware of the many benefits of using press releases to generate exposure to your business’s brand as well as more traffic to your website. Syndicated press releases can result in a short burst of traffic to your website and can also help to improve your SEO rankings for your business’s primary keywords. Press releases need to be written in a particular format in order to be syndicated on the widest possible number of websites. Mediocre press releases are not likely to be republished, and if they are very poorly written they can even hurt your business’s image.

                    At Writer Army we have experienced press release copywriters who can produce high quality press releases on a regular basis for your business. Our press releases are formatted for publishing on the best press release syndication services. We work on several revisions of your release to ensure that it is free of grammatical mistakes, and we hire our best copywriters to create your press release. We will spend the time needed to get acquainted with your particular business.

                    We will summarize your company’s news in a concise and compelling format that will guarantee the highest chance of republishing. Best of all we only charge you a fraction of what an advertising agency would cost to develop a quality press release for you. We will format your release for distribution on any platform that you may wish to use and it will include the standard press release format with a headline, summary and boilerplate.

                    What’s included in our press release copywriting service
                    We include the following with each press release order:

                    Written by our top US press release copywriters
                    Formatted for distribution on the widest range of services
                    Fast turnaround time of 3-5 business days (rush delivery available)
                    Can include multiple SEO keywords at a density of 1-3% as needed
                    Multiple revisions available if needed
                    Copywriters will research your business extensively
                    100% money back guarantee with your release
                    How our press release writing service benefits you
                    There are many benefits for hiring Writer Army to create a compelling and high quality press release for you. Most agencies that specialize in advertising or press release will charge hundreds of dollars or more to create a unique release. We will save you money will providing you with a professionally written release that you can publish on some of the best distribution services. Your website will gain the search engine optimization benefit of a properly optimized press release, and the high level of quality that we produce for the release will ensure that it is published on as many websites as possible.

                    A high quality press release can get you traffic and brand exposure for many months and years, and it can help your website rank for several targeted keywords. Our affordable cost allows you to make regular press releases a core part of your SEO strategy. If you have exciting business news, a new product or service, or an upcoming event, or anything else that you want the world to know about, a professionally written press release is one of the best ways to get attention to it.
            '],

            ['title' => 'Facebook Posting Service','slug'=>'facebook-posting-service', 'type'=>'social', 'price'=>'4.00', 'direct_posting_price'=>'1.50', 'image_path'=>'global/img/packages/facebook-posting-service.jpg',
                'description'=>
                    'With Facebook arguably being the most important social media website for businesses, it is crucial for you to post regularly to your Facebook business page to ensure that you keep your current customers interested and attract new customers through the website. We can help you build your business with targeted, well research and customized Facebook posts that will get your business page more likes, help drive more traffic to your website, and ultimately send more leads and business your way. Our Facebook posts are carefully researched based on your unique business, and we design them to be interesting to your readers.

                    You get the following when you purchase our Facebook post writing service:
                    Original, unique posts tailored to your specific company and brand
                    A wide range of different topics to choose from (news, entertainment, jokes, picture or video posts, and more)
                    100% satisfaction guaranteed
                    Discounts for bulk Facebook post orders
                    Posting management available at a small extra cost
                    3-5 business day turnaround time for most Facebook post orders
                    Save time and capitalize on Facebook
                    With our Facebook posting service you can save precious time and maintain your Facebook account by always having a steady supply of interesting and engaging content. It can take several hours out of your week just to maintain your Facebook and social media accounts, but we take this responsibility off your hands and ensure that you have the time to manage the other aspects of your business.

                    We highlight your business
                    We can highlight your business and give your company a human face with our Facebook posting service. This can include updates regarding news and events related to your business. Letting your customers take a look inside the operation of your company and being transparent on Facebook can help you build a substantial trust with your clients and strengthen your relationships. This can be accomplished by sharing pictures and video of your company events and culture.

                    We research your company
                    You need your Facebook posts to be created in your own voice to keep your customers interested and so that your marketing efforts look organic and completely authentic. That’s why we spend the time to research your company and find out what matters to your customers. We can give you ideas on the types of posts that would work well for your business if you haven’t done social media marketing before.

                    Experienced social media writers
                    Our experienced social media writers will do an excellent job at creating customized Facebook posts that are branded and exciting for your customers to read. We will help build your social media presence up so that it becomes another valuable marketing avenue for your company. Our experienced writers can both write your content and also post to your account. We employ several strategies including humor, videos, images, news, current events, question asking, and other forms of interaction and engagement that will get your visitors to interact with your company. We help you build trust and establish relationships with your current and future customers, which can motivate them to do business with you and help former customers remember you so that they come back in the future.'
            ],

            ['title' => 'Twitter Posting Service','slug'=>'twitter-posting-service', 'type'=>'social', 'price'=>'2.00', 'direct_posting_price'=>'1.00', 'image_path'=>'global/img/packages/twitter-posting-service.jpg',
                'description'=>
                    'With our Twitter posting service you can get regular tweets delivered to you and posted to your account for a small extra cost per tweet. When you maintain your Twitter account you will drive more interest to your website and blog while attracting more customers. Updating your Twitter account regularly can end up being time consuming and taking away from the other aspects of running your business. We started our Twitter tweet service to help our customers maintain their Twitter accounts and capitalize on this important marketing avenue.

                    You get the following when you purchase our Twitter posting service:
                    Customized tweets tailored to your specific business
                    Fast turnaround of 3-5 business days
                    Twitter posting available at a small additional cost
                    All tweets written by writers with social media experience
                    Discounts for bulk tweet orders
                    Tweets customized for your business
                    We research your business, look at any past tweets that you have done if you have any, and ensure that any tweets that we write for you are customized for your specific business. Your readers will be engaged and interested in your tweets, and you will get more followers by regularly posting to your account.

                    With our Twitter service you will save the time of having to update your account regularly and be able to focus on your business. We can update your account multiple times per day and ensure that your followers have regular content and updates to look forward to.

                    Engaging and entertaining tweets
                    The tweets that we produce for you will engaging and entertaining, and we can customize them based on how you naturally interact with your customers. We will adjust the tone and the style of writing to match your business as close as possible. We can work with both individuals and companies with our Twitter tweet service and our writers will do the research necessary to learn about your business.

                    We customize our service for you
                    We always tailor our service for your specific business and won’t write a bunch of generic tweets that won’t do anything for your business. We spend the time needed to learn how you interact with your customers. Any instructions that you have regarding how you want your tweets to be written will be carefully followed. Your tweets will also be delivered in the time that you need them, and we can handle posting if needed.

                    Twitter posting available
                    If you need us to handle posting Tweets to your account, Contact Us and get a quote. We can add this service on for a small extra charge per tweet, and this can save you the time of having to post the content to your account. We can also come up with a bulk package that includes writing the tweets and posting them, and we can manage your accounts on a monthly basis. Our Twitter tweet service will save you time and help you maximize the huge sales potential that Twitter has to offer for virtually every business with a web presence.'
            ],

            ['title' => 'Google Plus Posting Service','slug'=>'google-plus-posting-service', 'type'=>'social', 'price'=>'4.00', 'direct_posting_price'=>'1.50', 'image_path'=>'global/img/packages/google-plus-posting-service.png',
                'description'=>
                    'Google Plus has emerged as a strong competitor to some of the more established social media websites, and as a result it is important for businesses to have a Google Plus presence with regularly updated content to attract followers. Google Plus has some similarities to Facebook in terms of the type of content that can draw attention and get new followers, and we can produce any type of content that you may need for your Google Plus page to help your business maximize its exposure on this important social media venue.

                    You get the following when you order our Google Plus posting service:
                    100% unique Google Plus posts tailored to your business
                    3-5 day turnaround time on most Google Plus orders
                    Written in your company voice and designed to attract followers
                    100% satisfaction guaranteed with every Google Plus order
                    Discounts for bulk Google plus orders
                    Google Plus post management available
                    Written by experienced social media writers
                    Content tailored for your company
                    Our Google Plus post writing service is unique because we tailor our content specifically for your company. Your followers will find the content interesting and engaging because we research what matters to them the most. We can post news, funny stories, video posts, motivational posts, picture posts, quotes, and a wide range of other types of posts that can draw attention.

                    Our goal with our Google Plus post writing service is to help you build up your follower base, to maintain the interest of the customers and followers that you already have, and ensure that you are using this medium to its maximum potential for your business. We take the time necessary to learn about your business and to learn what type of content that your customers are looking for, and this extra research makes a major difference in the quality of the posts that we create for you.

                    Engaging and entertaining content
                    To attract readers you need to post entertaining and engaging content that your readers and potential customers will appreciate. We will research and learn how you interact with your customers normally to figure out the appropriate tone and voice for your posts. We can alternate between different types of posts such as news, joke posts, pictures, videos and other entertaining or education content based on your preferences. We can also research competitors to get ideas as to what might work good for your company, and we can meet with you to discuss the type of social media content that might work well for your specific business.

                    Google Plus posting management available
                    If you need someone to manage your Google Plus posts, we can handle all aspects of your posting campaign for a small additional charge per post. This can save you a substantial amount of time, especially if you are looking to update your Google Plus account on a regular basis. We have bulk order discounts available and we can also discount you if you purchase both post writing and posting in bulk. Our post management is handled by our experienced U.S. social media writers.'
            ],
        ]);
    }
}
