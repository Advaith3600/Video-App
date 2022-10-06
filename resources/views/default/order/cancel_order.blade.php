<html lang="en">
   <head>
      <style>@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap'); html { color: #888; font-family: 'Ubuntu', sans-serif; }

       </style>
   </head>
   <body bgcolor="#EFF2F7" style="background-color: #EFF2F7; padding: 30px 0; margin: 0; width: 100%;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 600px; min-width: 600px; border-radius: 6px 6px 6px 6px; margin: 0 auto; margin-top: 30px;" width="600">
         <tbody>
            <tr>
               <td align="center" bgcolor="#EFF2F7" class="frame" style="padding: 0px 0px;">
                  <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                     <tbody>
                        <tr>
                           <td style="text-align: center;"><a href="{{trans_url('/')}}"><img style="display: inline-block; height: 55px;" src="{{$url}}"></a></td>
                        </tr>
                        <tr>
                           <td height="10" style="line-height:10px; height:10px;"> </td>
                        </tr>
                       
                        <tr>
                           <td height="40" style="line-height:40px; height:40px;"> </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <tr>
               <td bgcolor="#fff" class="space" height="40" style="border-radius: 6px 6px 0px 0px;"> </td>
            </tr>
            <tr>
               <td align="center" bgcolor="#ffffff" class="frame" style="padding: 0px 40px;">
                  <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                     <tbody>
                        <tr>
                           <td align="center" class="bodyTitle" style="font-size: 20px; line-height: 28px; color: #3c4858; text-align: left; font-weight: 700; font-style: normal; text-decoration: none;"> <span style="color: #3c4858;"> Hello ,</span> </td>
                        </tr>
                        <tr>
                           <td height="10" style="line-height:10px; height:10px;"> </td>
                        </tr>
                        <tr>
                           <td align="center" class="bodyText" id="content-8" style="color: #3c4858; font-size: 14px; line-height: 24px; font-weight: 300; text-align: left;">
                              <div class="text">
                                 <p style="color:red;">Following order have been cancelled by the user.</p>
                                 <p style="margin-top: 0px; margin-bottom: 20px;"> {{@$order_code}}</p>
                                 
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="10" style="line-height:10px; height:10px;"> </td>
                        </tr>
                        
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td bgcolor="#ffffff" class="space" height="40" style="border-radius: 0px 0px 6px 6px;"> </td>
            </tr>
         </tbody>
      </table>
      <table align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth" style="width: 600px; min-width: 600px; margin-top: 30px;" width="600">
         <tbody>
            <tr>
               <td align="center" class="bodyTitle" id="content-31" style="line-height: 24px; font-size: 14px; color: #8492a6;">
                  <a href="#" style="display: inline-block; margin-right: 20px;">
                     <img style="display: inline-block; height: 30px;" src="data:image/png;base64,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" alt="">
                  </a>
                  <a href="#" style="display: inline-block; margin-right: 20px;">
                     <img style="display: inline-block; height: 30px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAAsQAAALEBxi1JjQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAVqSURBVFiFnZdLbBVVGMd/58z03va2pRRaGi0lESU+IKkJDx+gCRBX6ILAQhcERRP3LmThwg0bjYk7YoSVMVFjjCx8BAMRRNCIhggBDEGI0Iq2lb5ob+/cmfO5OHNmztw+eJxk7p05c873/77/9zqjaBwnZQ3CJoReoBtYBnSlVxnoTFc2Ay3p/TRQA0BkFKihGMEwAjIEZhijB5H4BFvK5304ld39KCsQDgLPzVIKQLKffKcA4s2h0vl0Lvv39oo5jEpeY3NlIFfAgp8CegGIY0hiu8kXogDldFYpoFNAeyDpOqUoKI1yygyikyfZXBnQ6YaDQC9ioDoFURWSOiQJGFPkShoexGNCKK41Aib9T8TKEgGRXhJ9wC49KWswnANgZsqCOgla5ZY6I929qCKY581cEY8BEbvE+Ev1YyHCJgDieg7eKNT5VXSDK3zhKb0qBXJB4vzvx4u4vfGzIdBnFYiLFihdpNm30IE6gUrlLsiUaQhY1aCM/VkeInRZgaa4IVuoi89OuJvzwNq0EKGIfHBRRWA/SzBdGpvruVAvvpaEaYT5ASb+nAIj7OyMuPiEZnJrhaktzXy12rCqFNOiDLuW1emTCazzPeaszFSBTKjKgRScWldiS3s9tdTbnJEl7OmO+HxdB48sKgMQKsW2+1o5s7GV/zZXeGEpDI2Pw/S4ZTljQ0CkW4N0FQPEWtsdJDy8qMw3Gzp4vSee7VOBFp3w3up25hqtoUYrWFIK2L2yA6IaVCeLDBi6NEbarGaSBxBQM4pEhHKg+KB/MUf6NWtb6tYCYxVdWzF0loI5FQAoacWxoRk+vHLLyjUR1G55GSFtISLljPcsoBQTieLbG1M8f38bAFt7KvzaU+H0zSqHhyJOjMLyZpkPG4DJumHfxbG0KqYpHNeBaQibAcohIiXLQDG6e5qEd68aHmqrZf4FWL+khfVLWuYEbBz/zCQWXGsvo5Qt86oGulQOEcq5f/PUaxLDDxs7qZuFrVxoDFYTC+rqiOsjSoNJQKKKtgy4LCBjYKCu+H5omiat5hF/+3F8eCa9U6R13CtwCsQ06byiuVaqMo13natzYbx2zwoc+ruaWp0WM6UpVFRj+Yky/xfSEQZrilfOTPLFtTHu1hPHhmf4fbyeA2aW4/UN6hqRWqG6OfR07tF2zY4Vi7kbTwiw9+wY+ZnBoz0DV6B1XSMSFRpLJsIy8tGNgPcvjXE3BOy7MM4vN+u55a47+uBKg+jIYyAtbya9Mk8Ib1yCNd8NcODy6G3BP7s+xdvnJ1LjgwXAFSBRiDBZ7FBeh0unHm8TXl7ewe6VbfMCC/DOH+O8dX7Cyr4duH03HSIyklEOgAYjPNNe481VbfR3lumrNC1o9W+jEXvPjnJ0KLozy13XFUZCjAzbg6XXt4ETt0qcPz3Mi73NbOttZ8PSFrrKtu5XE+HadMyRf6scGqxydGgGyVLtjsFB6eEQZLgYYXlbvqkXsf/qBPsvjwGaUqApBwGTMfa8KK663Qs4gAynLnDYrhvmtYByB0QBxDNEoojiVOgs8HlSbV5wDYEaChEZyMCcEtlZL30uVaygJEpB5wD35+8EHCDmekhiTlo6yWPAP+W6RhK2NChxr7T7FTE6buvboZFTIE9ldcAfTrhrVia2F57lha8l5w6VT4kvJxs/sX3Z0yEAQWkPtVs/g+nIXkvD+sZndzTyz5EOXNKvD4VnkGt2AgTjxPJqUaVPB/rR9S8xyQPMOxq0cJa7aXfqKaz39whofQUVbmdn39lZnADwyZ/bUOYlxKwA6URMJ2JagWaQACMBGJXGgUIFoNMvVAMEJAgGoYZiCsIxtIwi+i+a1MfsePBrH+5/iOTU3zuFDDIAAAAASUVORK5CYII=" alt="">
                  </a>
                  <a href="#" style="display: inline-block;">
                     <img style="display: inline-block; height: 30px;" src="data:image/png;base64,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" alt="">
                  </a>
               </td>
            </tr>
            <tr>
               <td height="10" style="line-height:10px; height:10px;"> </td>
            </tr>
            <tr>
               <td align="center" class="bodyTitle" id="content-31" style="line-height: 24px; font-size: 14px; color: #8492a6;">
                  <p style="margin-top: 0px; margin-bottom: 10px;"> Copyrignts © 2021 All Rights Reserved By b2buy</p>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>