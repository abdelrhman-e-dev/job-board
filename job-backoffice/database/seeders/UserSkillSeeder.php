<?php

namespace Database\Seeders;

use App\Models\UserSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSkillSeeder extends Seeder
{
  public function run(): void
  {
    $jobSeekerIds = [
      '01kfp9y9dsfv8ssxbkys7g4649',
      '01kfp9ybpz9fsde7t46jw14bvk',
      '01kfp9y9phv34g89vmb939nc5z',
      '01kfp9ya0q41wbvwqpfx252ttv',
      '01kfp9ya8cghv606mpsaybkz76',
      '01kfp9yag1vwd1esqmk34ywt0s',
      '01kfp9yaqy98vpbtx84wb9y06x',
      '01kfp9yazr3qtznczyd5n8dk4s',
      '01kfp9yb7cdqg18w5e8z1as55j',
      '01kfp9ybf3f12e7w3h7ngk3jqx',
    ];

    $skillIds = [
      '01kfpa72gq11b3ctkr79wx1apa',
      '01kfpa72j0mev64b4smxne7wtj',
      '01kfpa72jcgype7sa8wr30qdw9',
      '01kfpa72jp6wjs5k1wzsg9pxdd',
      '01kfpa72jtjej8v2xp56v1mq8n',
      '01kfpa72jyyvmnabberqz5962m',
      '01kfpa72k2kwp2tcrbkxdb243b',
      '01kfpa72k77jwgygy7rxd2xb1v',
      '01kfpa72kb21gsk7erkfb6a69r',
      '01kfpa72kfxtctdm443457ebcw',
      '01kfpa72kmc50kyvxyyqdrjsd8',
      '01kfpa72krea5thq1rjcswmzx7',
      '01kfpa72kwqqdynhgkx9s1eej2',
      '01kfpa72m0qhvf1yk6aed8nfb2',
      '01kfpa72m4jbhfr4szw2jr0j1a',
      '01kfpa72m7p5t35x3eyymn0wtn',
      '01kfpa72mbyscvagc5q904txj1',
      '01kfpa72mfcs4vgp09vhn3prvq',
      '01kfpa72mk5netz21qebsqyjpw',
      '01kfpa72mrcpyryt1vby6nkh7w',
      '01kfpa72mvx0p7rnb5fwyaj1rn',
      '01kfpa72myagnc3mfpbry0y7mp',
      '01kfpa72n1hf5qa9wyfk07w8yk',
      '01kfpa72n557rbbht88yzrdgwa',
      '01kfpa72n9v1d5vp5qahz2qjfw',
      '01kfpa72nc0svy9p6xy4w3gpb8',
      '01kfpa72nf93gq10q19wg2p9zr',
      '01kfpa72nkgtgj4332cg9v0gtq',
      '01kfpa72npjwtg5htw1111tnfc',
      '01kfpa72nt3xbkasry8dfz1f2n',
      '01kfpa72nx3qe1yepd6jvb34kw',
      '01kfpa72p1ppq0kpy9zdc60fww',
      '01kfpa72p4y444wfetwzaytf2s',
      '01kfpa72p7kww3ktj3g73fjrw0',
      '01kfpa72pasqjvfkbbwjstkv9r',
      '01kfpa72pd1q35q6m1jbk0v8fw',
      '01kfpa72pgm9gd36a0mscg35hz',
      '01kfpa72pmy66jced0fa27y8tw',
      '01kfpa72pqd7wtgf6bycq3cqz6',
      '01kfpa72ptcztbf4c0kpjz9dpq',
      '01kfpa72pxyv45bhsp616jpye5',
      '01kfpa72q0w3k44amvc46q738b',
      '01kfpa72q3djdtfhker1y96qdc',
      '01kfpa72q6cyr905w5tt9qrjf4',
      '01kfpa72q9w1jq0zfqmps2r32p',
      '01kfpa72qcyp85dvrntschwscb',
      '01kfpa72qfqgkck1sjnzms4gzv',
      '01kfpa72qk3r0pcbkfk5bd2hez',
      '01kfpa72qp4e991rs5epfgemaz',
      '01kfpa72qs6ejhrgqenkqvetvn',
      '01kfpa7k2sbtfmke4be1mmps38',
      '01kfpa7k3abmhaf6bnk37qc3kc',
      '01kfpa7k3fmwrjrz15qrvs297m',
      '01kfpa7k3kbbrns4pbj89wanxe',
      '01kfpa7k3px55tzpqx0tr4sv81',
      '01kfpa7k3s75bbfrmmwcxbr68y',
      '01kfpa7k3xjw7q5t1r48w154rc',
      '01kfpa7k40rvf2mamv9ptv6kv3',
      '01kfpa7k44m4qjw57dwhjq6sk7',
      '01kfpa7k4744ztkmkk26b3dhgk',
      '01kfpa7k4az9gxnwn8xnbswqyn',
      '01kfpa7k4d6gq7mwx8hcm2frjm',
      '01kfpa7k4ha8zdtp5j1gjfw9fj',
      '01kfpa7k4mw5z9qe8cp2e7vej9',
      '01kfpa7k4qmrh2zqxh2ns5522n',
      '01kfpa7k4txf13apw4c8qxxdm5',
      '01kfpa7k4xxrxw6bae2ygy8rrd',
      '01kfpa7k50c73fnnb7sm0ddf4z',
      '01kfpa7k53k56mvn7m71y4mjtw',
      '01kfpa7k56361gvsk2md8qb9qm',
      '01kfpa7k59nk72t6f1x76qae13',
      '01kfpa7k5dqkh9xjtj2g8mm59j',
      '01kfpa7k5hw0gcvvm147vwwdj2',
      '01kfpa7k5mq88kng818xt7rxzq',
      '01kfpa7k5qjxbhag6xb5mvbtv2',
      '01kfpa7k5v322ft3zyanc1fnxn',
      '01kfpa7k5yrzass8m06pqgt3zj',
      '01kfpa7k62apr6gqj83eqz8f9h',
      '01kfpa7k645ryfepvj65e2cm9g',
      '01kfpa7k677n614z7dz64s1663',
      '01kfpa7k6bt7s1hg8t4ajqqybk',
      '01kfpa7k6egw1709cgk53x2yg4',
      '01kfpa7k6h17bty8snwfeyd9km',
      '01kfpa7k6mcd27w8q353zc2s80',
      '01kfpa7k6qhzetrvc45q49rw67',
      '01kfpa7k6ttmtj81y7k0vxb3t3',
      '01kfpa7k6x1mvv4pp8b0zk50gr',
      '01kfpa7k711t5vby5t421y027y',
      '01kfpa7k75wkrt4y3qnqk5yybt',
      '01kfpa7k799zgzf7j62xh3wm7a',
      '01kfpa7k7c4p81nf578c6ws753',
      '01kfpa7k7e4w8hf45ph4d51t17',
      '01kfpa7k7h8tx8s6d462argt34',
      '01kfpa7k7m9rxdsyssv953f9ax',
      '01kfpa7k7q54knqgdr0exwccj8',
      '01kfpa7k7tqa0n48rsw5sk9280',
      '01kfpa7k7xfaa52j9s556tw3ts',
      '01kfpa7k80m7kknbz8at7nsjmc',
      '01kfpa7k836bayfpxyzqpb7qbx',
      '01kfpa7k86pred9mmsr0avmsn4'
    ];

    $skillIndex = 0;

    foreach ($jobSeekerIds as $userId) {
      // assign 2 skills per user
      for ($i = 0; $i < 2; $i++) {
        UserSkill::create([
          'user_id' => $userId,
          'skill_id' => $skillIds[$skillIndex],
        ]);
        $skillIndex++;
        // reset if skills run out
        if ($skillIndex >= count($skillIds)) {
          $skillIndex = 0;
        }
      }
    }
  }
}

