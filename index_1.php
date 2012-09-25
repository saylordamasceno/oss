<!DOCTYPE html>
<html>
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
    <link rel="stylesheet" href="../css/uniform.default.css" type="text/css" media="screen">
    <style type="text/css" media="screen">
      body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #666;
        padding: 40px;
      }
      h1 {
        margin-top: 0;
      }
      ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      li {
        margin-bottom: 20px;
        clear: both;
      }
      label {
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
        display: block;
        margin-bottom: 3px;
        clear: both;
      }
    </style>
  </head>
  <body>
    <h1>Uniform Demo</h1>
    <form>
      <ul>
        <li><label>Message:</label><textarea cols="40" rows="5"></textarea></li>
        <li><label>Your Name:</label><input type="text" size="40"/></li>
        <li><label>Your Email:</label><input type="email" size="40"/></li>
        <li>
          <label>I found your site:</label>
          <select>
            <option>Through Google</option>
            <option>Through Twitter</option>
            <option>Other&hellip;</option>
            <option>&lt;Hi&gt;</option>
          </select>
        </li>
        <li>
          <label><input type="radio" name="radio" /> Saying hi</label>
          <label><input type="radio" name="radio" /> Sending feedback</label>
        </li>
        <li>
          <label><input type="checkbox" /> Please contact me back</label>
        </li>
        <li>
          <label>Upload a file:</label>
          <input type="file" />
        </li>
        <li>
          <input type="submit" />
          <input type="reset" />
        </li>
      </ul>
    </form>
  </body>
</html>
