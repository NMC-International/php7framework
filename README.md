# Php 7 Framework
A PHP framework completely written in PHP 7, No PHP 5 support.

# Why another framework
For a long time I wanted to develop a Php framework by myself.  All the existing PHP Frameworks are heavy in size.Because they are designed to support backward compatibilities. But when anyone wants to start a new project and has a option to do it with only Php 7, he has no option to dump those backward compatibilities code within any frameworks. That's why I have decided to make a Php 7 only framework. As Php7 is already optimized for performance and security, the framework will be lightening fast.

# Founder & Contributor

:octocat:[Engr. Syed Rowshan Ali](https://github.com/Engr-Rowshan)

# Development Life Line
There will be two main branch
* **master** 
* **development**

All the development will be done in **development** branch. Only stable branch will be merged to **master**.

So,  **Master** is **Stable**. And **Development** is **Unstable**.

Anyone want to contribute should fork from master.

# How to use this framework
### In windows and xampp
1. Make sure you have installed xampp with Php7 Version. We have tested with Xampp 3.2.3.
2. Clone the repository or extract the zip into a subdirectory of **htdocs** folder of xampp. ex. "C:\xampp\htdocs\php7framework"
3. Create a virtual host or use the root directory of htdocs folder
4. Remember, the entry point of the framework in the **index.php** file located into the **public_html** folder. So on creation of vhost into xampp make the **public_html** folder as the root directory.
5. You are ready to use the framework
6. Now follow the documentation to use the framework (Not ready yet)

# Codding Standard
### Must Avoid
* Any Php5 feature discontinued into Php7
* Any function of extension which is not available Php7

## Controller
Controller name must be UcFirst and must ends with _C and should be reside into the controller director. Controller file must be a PHP Class with inherit Controller Class.

## Model
Model name must be UcFirst and should be resign in model directory. Model file must be a Class with inherit Model Class.

## View
View files should be reside in view directory or in sub directories of view. View file must be a fresh php file.

